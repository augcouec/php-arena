<?php

class Warrior extends Enemy
{
  function __construct($location)
  {
    parent::__construct($location);
    $this->symbol = 'W';
  }
}
