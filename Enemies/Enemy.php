<?php

class Enemy extends Item
{
  function __construct($location)
  {
    parent::__construct($location);
  }

  public function interactWith(Player $player)
  {
    $player->setHealthPoints($player->getHealthPoints() - 30);
  }
}
