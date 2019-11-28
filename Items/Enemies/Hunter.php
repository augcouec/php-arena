<?php

class Hunter extends Enemy
{
  /**
   * __construct
   *
   * @param array $location
   */
  function __construct(array $location)
  {
    parent::__construct($location);
    $this->symbol = 'H';
  }

  /**
   * interactWith
   *
   * @param Player $player
   * @return void
   */
  public function interactWith(Player $player)
  {
    $player->removeHealthPoints(50);
  }
}
