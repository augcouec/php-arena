<?php

class Game
{
    const COLUMNS = 12;
    const ROWS = 15;
    const ARMORS = 4;
    const POTIONS = 2;
    const ENEMIES_GROUPS = 3;

    private $items = [];
    private $player;
    private $map;

    /**
     * start
     *
     * @return void
     */
    public function start(bool $firstStart = false)
    {
        $this->reset();
        if (!$firstStart) {
            ViewManagerCli::askForStart();
        }
        $this->initItems();
        ViewManagerCli::displayPlayerStats($this->player);
        $this->initMap();
        ViewManagerCli::askForMovement($this);
    }

    /**
     * reset
     *
     * @return void
     */
    private function reset()
    {
        $this->items = [];
        $this->player = null;
        $this->map = null;
    }

    /**
     * initItems
     *
     * @return void
     */
    private function initItems()
    {
        $this->player = new Player([1, 1]);
        array_push($this->items, $this->player);

        for ($i = 0; $i < self::ARMORS; $i++) {
            array_push($this->items, new Armor($this->generateLocation()));
        }

        for ($i = 0; $i < self::POTIONS; $i++) {
            array_push($this->items, new Potion($this->generateLocation()));
        }

        for ($i = 0; $i < self::ENEMIES_GROUPS; $i++) {
            array_push(
                $this->items,
                new Hunter($this->generateLocation()),
                new Mage($this->generateLocation()),
                new Warrior($this->generateLocation())
            );
        }
    }

    /**
     * initMap
     *
     * @return void
     */
    private function initMap()
    {
        $this->map = new Map(self::COLUMNS, self::ROWS);
        $this->map->fill($this->items);
        $this->map->render();
    }

    /**
     * generateLocation
     *
     * @return array
     */
    private function generateLocation(): array
    {
        $location = [
            random_int(2, (self::COLUMNS - 1)),
            random_int(2, (self::ROWS - 1))
        ];

        if (!$this->isLocationAvailable($location)) {
            $location = $this->generateLocation(true);
        }

        return $location;
    }

    /**
     * isLocationAvailable
     *
     * @param array $location
     * @return boolean
     */
    public function isLocationAvailable(array $location): bool
    {
        foreach ($this->items as $item) {
            if ($item->getCoordX() === $location[0] && $item->getCoordY() === $location[1]) {
                return false;
            }
        }
        return true;
    }

    /**
     * isLocationAllowed
     *
     * @param array $location
     * @return boolean
     */
    public static function isLocationAllowed(array $location): bool
    {
        if (($location[0] > 0 && $location[0] < (self::ROWS - 3)) && ($location[1] > 0 && $location[1] < (self::COLUMNS + 3))) {
            return true;
        }
        return false;
    }

    /**
     * checkForConflict
     *
     * @return void
     */
    public function checkForConflict()
    {
        foreach ($this->items as $item) {
            if ($item instanceof Player) {
                continue;
            }

            if ($item->getCoordX() === $this->player->getCoordX() && $item->getCoordY() === $this->player->getCoordY()) {
                return $item;
            }
        }
        return false;
    }

    /**
     * checkForEnemies
     *
     * @return void
     */
    public function checkForEnemies()
    {
        foreach ($this->items as $item) {
            if ($item instanceof Hunter || $item instanceof Mage || $item instanceof Warrior) {
                return true;
            }
        }

        return false;
    }

    /**
     * deleteItem
     *
     * @param [type] $item
     * @return void
     */
    public function deleteItem($item)
    {
        $index = array_search($item, $this->items);
        if ($index) {
            array_splice($this->items, $index, 1);
        }
    }

    /**
     * getMap
     *
     * @return Map
     */
    public function getMap(): Map
    {
        return $this->map;
    }

    /**
     * getPlayer
     *
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }
}
