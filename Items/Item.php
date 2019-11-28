<?php

class Item
{
  protected $x;
  protected $y;
  protected $symbol;

  /**
   * __construct
   *
   * @param array $location
   */
  function __construct(array $location)
  {
    $this->x = $location[0];
    $this->y = $location[1];
  }

  /**
   * getSymbol
   *
   * @return void
   */
  public function getSymbol()
  {
    return $this->symbol;
  }

  /**
   * getCoordX
   *
   * @return integer
   */
  public function getCoordX(): int
  {
    return $this->x;
  }

  /**
   * getCoordY
   *
   * @return integer
   */
  public function getCoordY(): int
  {
    return $this->y;
  }

  /**
   * setCoordX
   *
   * @param integer $x
   * @return void
   */
  public function setCoordX(int $x)
  {
    $this->x = $x;
  }

  /**
   * setCoordY
   *
   * @param integer $y
   * @return void
   */
  public function setCoordY(int $y)
  {
    $this->y = $y;
  }
}
