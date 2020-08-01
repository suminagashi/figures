<?php

namespace Suminagashi\FiguresBundle\Tools;

use Suminagashi\FiguresBundle\Repository\FigureRepository;

class Figures
{
  public function __construct(FigureRepository $repo)
  {
    $this->repo = $repo;
  }

  public function get(string $key, \Datetime $start, \Datetime $end)
  {
    return $this->repo->getByRange($key, $start, $end);
  }
  public function getToday(string $key)
  {
    $today  = mktime(date("H"), date("i"), date("s"), date("m"),   date("d")-1,   date("Y"));

    $end = date('Y-m-d H:i:s');
    $start = date('Y-m-d H:i:s',$today);

    return $this->repo->getByRange($key, $start, $end);
  }
  public function getLastweek(string $key)
  {
    $lastWeek  = mktime(0, 0, 0, date("m"),   date("d")-7,   date("Y"));

    $end = date('Y-m-d H:i:s');
    $start = date('Y-m-d H:i:s',$lastWeek);

    return $this->repo->getByRange($key, $start, $end);
  }
  public function getLastmonth(string $key)
  {
    $lastMonth  = mktime(0, 0, 0, date("m")-1,   date("d"),   date("Y"));

    $end = date('Y-m-d H:i:s');
    $start = date('Y-m-d H:i:s',$lastMonth);

    return $this->repo->getByRange($key, $start, $end);
  }
  public function getLastyear(string $key)
  {

    $lastYear  = mktime(0, 0, 0, date("m"),   date("d"),   date("Y")-1);

    $end = date('Y-m-d H:i:s');
    $start = date('Y-m-d H:i:s',$lastYear);

    return $this->repo->getByRange($key, $start, $end);
  }
  public function all(string $key)
  {
    return $this->repo->getAll($key);
  }

}
