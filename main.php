<?php

include_once('bootstrap.php');

ViewManagerCli::askForStart();
$game = new Game();
$game->start(true);
ViewManagerCli::askForMovement($game);
