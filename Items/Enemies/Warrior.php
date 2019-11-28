<?php

class Warrior extends Enemy
{
  function __construct($location)
  {
    parent::__construct($location);
    $this->symbol = 'W';
  }

  public function interactWith(Player $player)
  {
    $player->removeHealthPoints(40);
  }
}
