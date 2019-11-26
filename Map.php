<?php

class Map
{
  private $grid;

  function __construct($columns, $rows)
  {
    $this->grid = array_fill(0, $columns, array_fill(0, $rows, '`'));

    // Top & bottom walls
    for ($i = 0; $i < $columns; $i++) {
      $this->grid[$i][0] = '║';
      $this->grid[$i][$rows] = '║';
    }

    // Left and right walls
    for ($i = 0; $i < $rows; $i++) {
      $this->grid[0][$i] = '═';
      $this->grid[$columns][$i] = '═';
    }

    // Angles
    $this->grid[0][0] = '╔';
    $this->grid[0][$rows] = '╗';
    $this->grid[$columns][0] = '╚';
    $this->grid[$columns][$rows] = '╝';
  }

  public function fill(array $items)
  {
    shuffle($items);
    foreach ($items as $item) {
      $x = $item->getCoordX();
      $y = $item->getCoordY();
      $this->grid[$x][$y] = $item->getSymbol();
    }
  }

  public function render()
  {
    foreach ($this->grid as $row) {
      foreach ($row as $col) {
        echo $col;
      }
      echo "\n";
    }
  }

  public function update(Player $player)
  {
    $this->grid[$player->getPreviousLocation()[0]][$player->getPreviousLocation()[1]] = '`';
    $this->grid[$player->getCoordX()][$player->getCoordY()] = $player->getSymbol();
    $this->render();
  }

  public function destroyItem($item)
  {
    $item->setCoordX(-1);
    $item->setCoordY(-1);
    $this->grid[$item->getCoordX()][$item->getCoordY()] = "`";
  }
}
