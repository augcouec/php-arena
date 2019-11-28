<?php

class Armor extends Item
{
  const ARMOR = 20;

  function __construct($location)
  {
    parent::__construct($location);
    $this->symbol = 'A';
  }
/**
 * interactWith
 *
 * @param Player $player
 * @return void
 */
  public function interactWith(Player $player)
  {
    $armor = $player->getArmor();
    $player->setArmor($armor + self::ARMOR);
  }
}
