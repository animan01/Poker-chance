<?php

namespace App\Entity;

use App\Entity\Suit;
use App\Entity\RankInterface;
class Rank implements RankInterface
{
    private $name;
    private $suit;

    public function __construct(Suit $suit)
    {
        $this->suit = $suit;
    }

    public function set(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function get(){
        return $this->suit->get() . $this->name;
    }
}