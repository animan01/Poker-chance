<?php

namespace App\Util;

class Calculator {

  /**
   * @param int $total
   * @param int $howMany
   *
   * @return float
   */
  public static function calculate(int $total, int $howMany) {
    $chance = ($howMany / $total) * 100;

    return round($chance, 2);
  }
}
