<?php

class Item
{
  protected $x;
  protected $y;
  protected $symbol;

  function __construct(array $location)
  {
    $this->x = $location[0];
    $this->y = $location[1];
  }

  public function getSymbol()
  {
    return $this->symbol;
  }

  public function getCoordX(): int
  {
    return $this->x;
  }

  public function getCoordY(): int
  {
    return $this->y;
  }

  public function setCoordX(int $x)
  {
    $this->x = $x;
  }

  public function setCoordY(int $y)
  {
    $this->y = $y;
  }
}
