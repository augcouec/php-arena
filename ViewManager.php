<?php

interface ViewManager
{
  static function askForMovement(Game $game);
  static function askForStart();
  static function displayPlayerStats(Player $player);
  static function displayLoseMessage();
  static function displayWinMessage();
}
