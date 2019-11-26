<?php

class Potion extends Item
{
  const HEAL = 50;

  function __construct($location)
  {
    parent::__construct($location);
    $this->symbol = 'P';
  }

  public function interactWith(Player $player)
  {
    $projection = $player->getHealthPoints() + self::HEAL;
    if ($projection > $player->getMaximumHealthPoints()) {
      $player->setHealthPoints($player->getMaximumHealthPoints());
    } else {
      $player->setHealthPoints($projection);
    }
  }
}
