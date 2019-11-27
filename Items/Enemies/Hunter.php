<?php

class Hunter extends Enemy
{
  function __construct($location)
  {
    parent::__construct($location);
    $this->symbol = 'H';
  }
}
