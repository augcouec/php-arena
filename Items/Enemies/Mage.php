<?php

class Mage extends Enemy
{
  function __construct($location)
  {
    parent::__construct($location);
    $this->symbol = 'M';
  }
}
