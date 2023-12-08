<?php

class Pile
{
    //atributes
    protected Card $pile;

    //Constructor
    public function __construct(Card $pile){
        $this->pile = [];
    }

    //getters
    public function getPile(): Card{
        return $this->pile;
    }

    public function addCard(Card $card): void{
        if (empty($card)) throw new Exception("Invalid card - cannot be empty!");
        array_push($this->pile, $card);
    }

    public function shuffle() : void
    {
        shuffle($this->pile);
    }
}