<?php

class Rock extends Item
{
  function __construct($location)
  {
    parent::__construct($location);
    $this->symbol = 'R';
  }
}
