<?php

class Player extends Item
{
  private $previousLocation;

  function __construct(array $coords)
  {
    parent::__construct($coords);
    $this->symbol = '█';
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

  private function setCoordX(int $x)
  {
    $this->x = $x;
  }

  private function setCoordY(int $y)
  {
    $this->y = $y;
  }
}
