<?php

namespace App;

use App\Game;
use App\ViewManagerCli;

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

            ViewManagerCli::displayPlayerStats($player);
            $map->update($player);

            if (!$game->checkForEnemies()) {
                ViewManagerCli::displayWinMessage();
                $game->start();
            }

            if ($player->getHealthPoints() <= 0) {
                ViewManagerCli::displayLoseMessage();
                $game->start();
            }
        } else {
            ViewManagerCli::displayPlayerStats($player);
            $map->render();
        }

        ViewManagerCli::askForMovement($game);
    }
}
