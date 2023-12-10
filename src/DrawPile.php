<?php

class DrawPile extends Pile
{
    protected Card $pile;

    public function __construct(Card $pile)
    {
        parent::__construct($pile);
        $this->initializeDrawPile();
    }

    private function initializeDrawPile() {
        //called all consts variable to fill the pile
        $colors = [Card::RED, Card::BLUE, Card::GREEN, Card::YELLOW];
        $specialSymbols = [Card::SKIP, Card::REVERSE, Card::PICKER];
        $symbols = range(0, 9);

        //normal cards (only one 0 for each color a doubles for the rest)
        foreach ($colors as $color) {
            foreach ($symbols as $symbol) {
                if ($symbol == 0) {
                    $this->addCard(new Card($color, $symbol));
                } else {

                    $this->addCard(new Card($color, $symbol));
                    $this->addCard(new Card($color, $symbol));
                }
            }
        }

        //now adding special cards
        foreach ($colors as $color) {
            foreach ($specialSymbols as $symbol) {
                $this->addCard(new Card($color, $symbol));
                $this->addCard(new Card($color, $symbol));
            }
        }

        for ($i = 0; $i < 4; $i++) {
                $this->addCard(new Card(Card::BLACK, Card::COLOR_CHANGER));
            $this->addCard(new Card(Card::BLACK, Card::PICK_FOUR));
        }

        $this->shuffle();
    }

    //getters
    public function getDrawPile(): Card
    {
        return $this->pile;
    }

    //methods and actions
    public function drawCard() {
        if (empty($this->cards)) {
            throw new Exception("El mazo está vacío");
        }

        return array_shift($this->cards);
    }

    public function addPileButLast(Pile $p) {
        if (count($p->getPile()) > 1) {
            $this->cards = array_merge($this->cards, array_slice((array)$p->getPile(), 0, -1));
        }
    }

    public function countCards() {
        return $this->pile->count();
    }

}