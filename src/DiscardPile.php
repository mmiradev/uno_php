<?php

class DiscardPile extends Pile
{
    public function __construct(Card $pile)
    {
        parent::__construct($pile);
    }

    //getters
    public function getDiscardPile(): Card
    {
        return $this->pile;
    }

    //methods and actions
    public function peekLastCard() {
        $lastIndex = count($this->pile) - 1;
        if ($lastIndex >= 0) {
            return $this->pile[$lastIndex];
        } else {
            throw new Exception("The pile is empty");
        }
    }

    public function clear() {
        if (count($this->pile) > 1) {
            $this->pile = [$this->pile[count($this->pile) - 1]];
        }
    }
}