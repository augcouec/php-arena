<?php

class Game
{
  const COLUMNS = 18;
  const ROWS = 22;
  const ARMORS = 4;
  const POTIONS = 2;
  const ENEMIES_GROUPS = 3;

  private $items = [];
  private $player;
  private $map;

  public function start()
  {
    $this->reset();
    $this->askForStart();
    $this->initItems();
    $this->displayPlayerHealthPoints();
    $this->initMap();
    $this->askForMovement();
  }

  private function reset()
  {
    $this->items = [];
    $this->player = null;
    $this->map = null;
  }

  private function initItems()
  {
    $this->player = new Player([1, 1]);
    array_push($this->items, $this->player);

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
    if (($location[0] > 0 && $location[0] < (self::ROWS - 3)) && ($location[1] > 0 && $location[1] < (self::COLUMNS + 3))) {
      return true;
    }
    return false;
  }

  private function displayPlayerHealthPoints()
  {
    echo "HP : " . $this->player->getHealthPoints() . "/" . $this->player->getMaximumHealthPoints() . "\n";
  }

  private function displayPlayerArmor()
  {
    $armor = $this->player->getArmor();
    if ($armor !== 0) {
      echo "Armor : " . $armor . "\n";
    }
  }

  private function handleMovement(string $direction)
  {
    $locationUpdated = $this->player->updateLocation($direction);
    if ($locationUpdated) {
      $conflictingItem = $this->checkForConflict();
      if ($conflictingItem) {
        $conflictingItem->interactWith($this->player);
        $this->map->destroyItem($conflictingItem);
        $this->deleteItem($conflictingItem);
      }
      $this->displayPlayerHealthPoints();
      $this->displayPlayerArmor();
      $this->map->update($this->player);
      if (!$this->checkForEnemies()) {
        echo "Vous avez gagné !" . "\n";
        $this->start();
      }
      if ($this->player->getHealthPoints() <= 0) {
        echo "Vous avez perdu !" . "\n";;
        $this->start();
      }
    } else {
      $this->displayPlayerHealthPoints();
      $this->displayPlayerArmor();
      $this->map->render();
    }
    $this->askForMovement();
  }

  private function checkForConflict()
  {
    foreach ($this->items as $item) {
      if ($item instanceof Player) {
        continue;
      }

      if ($item->getCoordX() === $this->player->getCoordX() && $item->getCoordY() === $this->player->getCoordY()) {
        return $item;
      }
    }
    return false;
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

  public function checkForEnemies()
  {
    foreach ($this->items as $item) {
      if ($item instanceof Hunter || $item instanceof Mage || $item instanceof Warrior) {
        return true;
      }
    }

    return false;
  }

  public function deleteItem($item)
  {
    $index = array_search($item, $this->items);
    if ($index) {
      array_splice($this->items, $index, 1);
    }
  }
}
