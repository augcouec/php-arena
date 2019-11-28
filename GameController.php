<?php

class GameController
{

  /**
   * newTurn
   *
   * @param Game $game
   * @return void
   */
  public static function newTurn(Game $game, string $direction)
  {
    $player = $game->getPlayer();
    $map = $game->getMap();

    $locationUpdated = $player->updateLocation($direction);
    if ($locationUpdated) {
      $conflictingItem = $game->checkForConflict();

      if ($conflictingItem) {
        $conflictingItem->interactWith($player);
        $map->destroyItem($conflictingItem);
        $game->deleteItem($conflictingItem);
      }

      ViewManager::displayPlayerStats($player);
      $map->update($player);

      if (!$game->checkForEnemies()) {
        ViewManager::displayWinMessage();
        $game->start();
      }

      if ($player->getHealthPoints() <= 0) {
        ViewManager::displayLoseMessage();
        $game->start();
      }
    } else {
      ViewManager::displayPlayerStats($player);
      $map->render();
    }

    ViewManager::askForMovement($game);
  }
}
