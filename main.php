<?php

include_once('bootstrap.php');

ViewManager::askForStart();
$game = new Game();
$game->start(true);
ViewManager::askForMovement($game);
