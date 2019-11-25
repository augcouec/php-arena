<?php

class Potion extends Item
{
  function __construct($location)
  {
    parent::__construct($location);
    $this->symbol = 'P';
  }
}
