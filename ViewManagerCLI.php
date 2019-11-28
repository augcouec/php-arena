<?php

class ViewManagerCli implements ViewManager
{
    /**
     * askForMovement
     *
     * @param Game $game
     * @return void
     */
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

    /**
     * askForStart
     *
     * @return void
     */
    public static function askForStart()
    {
        $start = CliUtil::getFromCli("Start a new game ? (yes/no)");

        if ($start === 'no') {
            die;
        } elseif ($start !== 'yes') {
            self::askForStart();
        }
    }

    /**
     * displayPlayerHealthPoints
     *
     * @param Player $player
     * @return void
     */
    private function displayPlayerHealthPoints(Player $player)
    {
        echo "HP : " . $player->getHealthPoints() . "/" . $player->getMaximumHealthPoints() . "\n";
    }

    /**
     * displayPlayerArmor
     *
     * @param Player $player
     * @return void
     */
    private function displayPlayerArmor(Player $player)
    {
        $armor = $player->getArmor();
        if ($armor !== 0) {
            echo "Armor : " . $armor . "\n";
        }
    }

    /**
     * displayPlayerStats
     *
     * @param Player $player
     * @return void
     */
    public static function displayPlayerStats(Player $player)
    {
        self::displayPlayerHealthPoints($player);
        self::displayPlayerArmor($player);
    }

    /**
     * displayLoseMessage
     */
    public static function displayLoseMessage()
    {
        echo "Vous avez perdu !" . "\n";
    }

    /**
     * displayWinMessage
     */
    public static function displayWinMessage()
    {
        echo "Vous avez gagné !" . "\n";
    }
}
