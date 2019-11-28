<?php

namespace App\Items\Bonuses;

use App\Items\Item;
use App\Items\Player;

class Potion extends Item
{
    const HEAL = 50;

    /**
     * __construct
     *
     * @param array $location
     */
    function __construct(array $location)
    {
        parent::__construct($location);
        $this->symbol = 'P';
    }

    /**
     * interactWith
     *
     * @param Player $player
     * @return void
     */
    public function interactWith(Player $player)
    {
        $projection = $player->getHealthPoints() + self::HEAL;
        if ($projection > $player->getMaximumHealthPoints()) {
            $difference = $player->getMaximumHealthPoints() - $player->getHealthPoints();
            $player->addHealthPoints($difference);
        } else {
            $player->addHealthPoints(self::HEAL);
        }
    }
}
