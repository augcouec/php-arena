<?php

class Mage extends Enemy
{
  function __construct($location)
  {
    parent::__construct($location);
    $this->symbol = 'M';
  }

  public function interactWith(Player $player)
  {
    $player->removeHealthPoints(60);
  }
}
