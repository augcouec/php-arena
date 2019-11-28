<?php

namespace App\Items\Enemies;

use App\Items\Item;

abstract class Enemy extends Item
{
    /**
     * __construct
     *
     * @param array $location
     */
    function __construct(array $location)
    {
        parent::__construct($location);
    }
}
