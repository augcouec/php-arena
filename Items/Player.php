<?php

class Player extends Item
{
  private $previousLocation;
  private $maximumHealthPoints = 300;
  private $currentHealthPoints = 300;
  private $armor = 0;

  function __construct(array $coords)
  {
    parent::__construct($coords);
    $this->symbol = '☻';
    $this->updatePreviousLocation();
  }

  private function move(array $location)
  {
    if (Game::isLocationAllowed($location)) {
      $this->updatePreviousLocation();
      $this->setCoordX($location[0]);
      $this->setCoordY($location[1]);
      return true;
    }
    return false;
  }

  public function updateLocation(string $direction)
  {
    switch ($direction) {
      case 'z':
        return $this->move([
          $this->getCoordX() - 1,
          $this->y
        ]);
      case 's':
        return $this->move([
          $this->getCoordX() + 1,
          $this->y
        ]);
      case 'q':
        return $this->move([
          $this->x,
          $this->getCoordY() - 1
        ]);
      case 'd':
        return $this->move([
          $this->x,
          $this->getCoordY() + 1
        ]);
    };
  }

  public function getPreviousLocation(): array
  {
    return $this->previousLocation;
  }

  private function updatePreviousLocation()
  {
    $this->previousLocation = [
      $this->getCoordX(),
      $this->getCoordY()
    ];
  }

  public function setArmor(int $armor)
  {
    $this->armor = $armor;
  }

  public function addHealthPoints(int $heal)
  {
    $this->currentHealthPoints += $heal;
  }

  public function removeHealthPoints(int $attack)
  {
    if ($this->armor >= $attack) {
      $this->armor -= $attack;
    } else {
      $this->currentHealthPoints -= $attack;
      if ($this->armor > 0) {
        $this->currentHealthPoints += $this->armor;
        $this->armor = 0;
      }
      if ($this->currentHealthPoints < 0) {
        $this->currentHealthPoints = 0;
      }
    }
  }

  public function getHealthPoints(): int
  {
    return $this->currentHealthPoints;
  }

  public function getMaximumHealthPoints(): int
  {
    return $this->maximumHealthPoints;
  }

  public function getArmor(): int
  {
    return $this->armor;
  }
}
