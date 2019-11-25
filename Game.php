<?php

class Game
{
  const COLUMNS = 12;
  const ROWS = 15;
  const ROCKS = 6;
  const ARMORS = 4;
  const POTIONS = 2;
  const ENEMIES_GROUPS = 3;

  private $items = [];
  private $player;
  private $map;

  public function start()
  {
    $this->askForStart();
    $this->initItems();
    $this->initMap();
    $movement = $this->askForMovement();
  }

  private function initItems()
  {
    $this->player = new Player([1, 1]);
    array_push($this->items, $this->player);

    for ($i = 0; $i < self::ROCKS; $i++) {
      array_push($this->items, new Rock($this->generateLocation()));
    }

    for ($i = 0; $i < self::ARMORS; $i++) {
      array_push($this->items, new Armor($this->generateLocation()));
    }

    for ($i = 0; $i < self::POTIONS; $i++) {
      array_push($this->items, new Potion($this->generateLocation()));
    }

    for ($i = 0; $i < self::ENEMIES_GROUPS; $i++) {
      array_push(
        $this->items,
        new Hunter($this->generateLocation()),
        new Mage($this->generateLocation()),
        new Warrior($this->generateLocation())
      );
    }
  }

  private function initMap()
  {
    $this->map = new Map(self::COLUMNS, self::ROWS);
    $this->map->fill($this->items);
    $this->map->render();
  }

  private function generateLocation(): array
  {
    $location = [
      random_int(2, (self::COLUMNS - 1)),
      random_int(2, (self::ROWS - 1))
    ];

    if (!$this->isLocationAvailable($location)) {
      $this->generateLocation();
    }

    return $location;
  }

  public function isLocationAvailable(array $location): bool
  {
    foreach ($this->items as $item) {
      if ($item->getCoordX() === $location[0] && $item->getCoordY() === $location[1]) {
        return false;
      }
    }
    return true;
  }

  public static function isLocationAllowed(array $location): bool
  {
    var_dump($location);
    if (($location[0] > 0 && $location[0] < (self::ROWS - 3)) && ($location[1] > 0 && $location[1] < (self::COLUMNS + 3))) {
      return true;
    }
    return false;
  }

  private function handleMovement($direction)
  {
    $locationUpdated = $this->player->updateLocation($direction);
    if ($locationUpdated) {
      $this->map->update($this->player);
    } else {
      $this->map->render();
    }
    $this->askForMovement();
  }

  private function askForStart()
  {
    $start = CliUtil::getFromCli("Start a new game ? (yes/no)");

    if ($start === 'no') {
      die;
    } elseif ($start !== 'yes') {
      $this->askForStart();
    }
  }

  private function askForMovement()
  {
    $key = CliUtil::getFromCli(
      "Move your character : " . " \n" .
        "Z key => up" . " \n" .
        "S key => bottom" . " \n" .
        "Q key => left" . " \n" .
        "D key => right"
    );
    $this->handleMovement($key);
  }
}
