<?php

class Hunter extends Enemy
{
  function __construct($location)
  {
    parent::__construct($location);
    $this->symbol = 'H';
  }

  public function interactWith(Player $player)
  {
    $player->removeHealthPoints(50);
  }
}
