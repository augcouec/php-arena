<?php

namespace App\Items\Enemies;

use App\Items\Enemies\Enemy;
use App\Items\Player;

class Warrior extends Enemy
{
    /**
     * __construct
     *
     * @param array $location
     */
    function __construct(array $location)
    {
        parent::__construct($location);
        $this->symbol = 'W';
    }

    /**
     * interactWith
     *
     * @param Player $player
     * @return void
     */
    public function interactWith(Player $player)
    {
        $player->removeHealthPoints(40);
    }
}
