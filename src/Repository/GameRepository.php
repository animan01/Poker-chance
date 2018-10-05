<?php

namespace App\Repository;

use App\Entity\Card;
use App\Util\Calculator;
use Symfony\Component\HttpFoundation\Session\Session;

class GameRepository {

  public $state = [];

  public $session;

  /**
   * GameRepository constructor.
   */
  public function __construct() {
    $this->session = new Session();
    $state = $this->session->get('state');
    if ($state) {
      $this->state = json_decode($state, TRUE);
    }
  }

  /**
   * @return bool
   */
  public function reset() {
    $this->session->remove("state");
    $this->state = [];

    return TRUE;
  }

  /**
   * @param string $cardName
   *
   * @return array|mixed
   */
  public function start(string $cardName) {
    $card = new Card();
    $deck = $card->createDeck();
    $this->state = ['deck' => $deck, 'card' => $cardName, 'history' => []];

    $this->save();

    return $this->state;
  }

  /**
   * @return bool
   */
  private function save() {
    if ($this->session) {
      return $this->session->set('state', json_encode($this->state));
    }

    return FALSE;
  }

  /**
   * @param string $card
   *
   * @return bool
   */
  public function compareCard(string $card) {
    return $card == $this->state['card'];
  }

  /**
   * @return mixed
   */
  public function myCard() {
    return $this->state['card'];
  }

  /**
   * @return mixed
   */
  public function selectCard() {
    $cardFactory = new Card();
    $card = $cardFactory
      ->set($this->state['deck'])
      ->draftCard();

    if (!$this->compareCard($card)) {
      $this->state['deck'] = $cardFactory->get();
    }
    $this->state['history'][] = $card;

    $this->save();

    return $card;
  }

  /**
   * @return float
   */
  public function calculateChance() {

    return Calculator::calculate(count($this->state['deck']), 1);
  }
}
