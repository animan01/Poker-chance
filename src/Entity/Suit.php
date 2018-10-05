<?php

namespace App\Entity;

class Suit implements SuitInterface {

  private $suit;

  public function __construct(string $suit) {
    $this->suit = $suit;
  }

  public function get() {
    return $this->suit;
  }
}
