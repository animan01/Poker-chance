<?php

namespace App\Tests;

use App\Entity\Card;
use App\Util\Calculator;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase {

  public function testCalculate() {
    $result = Calculator::calculate(2, 1);

    $this->assertEquals(50, $result);
  }

  public function testDeck() {
    $cardFactory = new Card();
    $result = $cardFactory->createDeck();

    $this->assertEquals(52, count($result));
  }

  public function testDraftCard() {
    $cardFactory = new Card();
    $deck = $cardFactory->createDeck();
    $card = $cardFactory
      ->set($deck)
      ->draftCard();
    $newDeck = $cardFactory->get();

    $this->assertEquals(count($deck) - 1, count($newDeck));
  }
}
