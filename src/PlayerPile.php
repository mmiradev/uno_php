<?php

class PlayerPile extends Pile
{
    public function __construct(Card $pile)
    {
        parent::__construct($pile);
    }


    //getters
    public function getPlayerPile(): Card
    {
        return $this->pile;
    }

    //methods and actions
    public function getCards() {
        return $this->pile;
    }

    public function playCard(Card $c) {
        $key = array_search($c, $this->pile, true);

        if ($key !== false) {
            // La carta está en el mazo, la eliminamos
            array_splice($this->pile, $key, 1);
        } else {
            throw new Exception("La carta no está en el mazo");
        }
    }
}