<?php
require "vendor/autoload.php";

use App\ViewManagerCli;
use App\Game;

ViewManagerCli::askForStart();
$game = new Game();
$game->start(true);
ViewManagerCli::askForMovement($game);
