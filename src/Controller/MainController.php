<?php

namespace App\Controller;

use App\Entity\Card;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends Controller {

  /**
   * @Route("/", name="main")
   */
  public function main() {

    return $this->render('main.html.twig', [
      'suits' => Card::SUITS,
      'ranks' => Card::RANKS,
    ]);
  }

  /**
   * @Route("/start", name="start")
   */
  public function start(GameRepository $gameRepository, Request $request) {
    $myCard = $request->get("suit") . $request->get("rank");
    $gameRepository->start($myCard);
    $chance = $gameRepository->calculateChance();

    $data = [
      'card' => $myCard,
      'selectedCard' => '-',
      'chance' => $chance,
      'win' => 0,
    ];

    return $this->render('draft.html.twig', ['data' => $data]);
  }

  /**
   * @Route("/draft", name="draft")
   */
  public function draft(GameRepository $gameRepository) {
    $card = $gameRepository->selectCard();
    $myCard = $gameRepository->myCard();
    $win = $gameRepository->compareCard($card);
    $chance = $gameRepository->calculateChance();

    $data = [
      'card' => $myCard,
      'selectedCard' => $card,
      'chance' => $chance,
      'win' => $win,
    ];

    return $this->render('draft.html.twig', ['data' => $data]);
  }

  /**
   * @Route("/reset", name="reset")
   */
  public function reset(GameRepository $gameRepository) {
    $gameRepository->reset();

    return $this->redirectToRoute('main');
  }
}
