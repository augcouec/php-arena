<?php

class Armor extends Item
{
  const ARMOR = 20;

  /**
   * __construct
   *
   * @param array $location
   */
  function __construct(array $location)
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
