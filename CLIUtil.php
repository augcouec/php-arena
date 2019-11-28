<?php

class CLIUtil
{
    private static $handler;

    /**
     * init
     *
     * @return void
     */
    public static function init()
    {
        self::$handler = fopen("php://stdin", "r");
    }

    /**
     * getFromCli
     *
     * @param string $text
     * @return string
     */
    public static function getFromCli(string $text): string
    {
        if (self::$handler === null) {
            self::init();
        }

        echo $text . " \n";

        return trim(fgets(self::$handler));
    }
}
