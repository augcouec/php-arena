<?php

class Armor extends Item
{
  function __construct($location)
  {
    parent::__construct($location);
    $this->symbol = 'A';
  }
}
