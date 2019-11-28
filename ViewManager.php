<?php

class ViewManager
{
  public static function askForMovement(Game $game)
  {
    $key = CliUtil::getFromCli(
      "Move your character : " . " \n" .
        "Z key => up" . " \n" .
        "S key => bottom" . " \n" .
        "Q key => left" . " \n" .
        "D key => right"
    );
    GameController::newTurn($game, $key);
  }

  public static function askForStart()
  {
    $start = CliUtil::getFromCli("Start a new game ? (yes/no)");

    if ($start === 'no') {
      die;
    } elseif ($start !== 'yes') {
      $this->askForStart();
    }
  }

  private function displayPlayerHealthPoints(Player $player)
  {
    echo "HP : " . $player->getHealthPoints() . "/" . $player->getMaximumHealthPoints() . "\n";
  }

  private function displayPlayerArmor(Player $player)
  {
    $armor = $player->getArmor();
    if ($armor !== 0) {
      echo "Armor : " . $armor . "\n";
    }
  }

  public static function displayPlayerStats(Player $player)
  {
    ViewManager::displayPlayerHealthPoints($player);
    ViewManager::displayPlayerArmor($player);
  }

  public static function displayLoseMessage()
  {
    echo "Vous avez perdu !" . "\n";
  }

  public static function displayWinMessage()
  {
    echo "Vous avez gagné !" . "\n";
  }
}
