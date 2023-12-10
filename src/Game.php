<?php

class Game
{
    //atributes
    private $players = [];
    private $drawPile;
    private $discardPile;
    private $currentPlayer;
    private $choosenColor = false;
    private $reverseTurn = false;

    //Constructor
    public function __construct($usernames) {
        foreach ($usernames as $username) {
            $this->players[$username] = new PlayerPile();
        }

        $this->drawPile = new DrawPile();
        $this->discardPile = new DiscardPile();
    }

    //methods and functions
    public function startGame() {
        foreach ($this->players as $player) {
            //each player starts with 7 cards
            for ($i = 0; $i < 7; $i++) {
                $player->addCard($this->drawPile->drawCard());
            }
        }

        do {
            $initialCard = $this->drawPile->drawCard();
        } while (
            $initialCard->getSymbol() == Card::PICK_FOUR ||
            $initialCard->getSymbol() == Card::COLOR_CHANGER ||
            $initialCard->getSymbol() == Card::SKIP ||
            $initialCard->getSymbol() == Card::REVERSE
        );

        $this->discardPile->addCard($initialCard);
        $this->currentPlayer = key($this->players);
    }

    public function getCurrentPlayer() {
        return $this->currentPlayer;
    }

    public function isChoosenColor() {
        return $this->choosenColor;
    }

    public function isReverseTurn() {
        return $this->reverseTurn;
    }

    public function switchTurn() {
        $playerUsernames = array_keys($this->players);
        $currentIndex = array_search($this->currentPlayer, $playerUsernames);

        if ($this->reverseTurn) {
            $currentIndex = ($currentIndex - 1 + count($playerUsernames)) % count($playerUsernames);
        } else {
            $currentIndex = ($currentIndex + 1) % count($playerUsernames);
        }

        $this->currentPlayer = $playerUsernames[$currentIndex];
    }

    public function playCard(Card $card) {
        if(empty($card)){
            throw new Exception("The card cannot be empty");
        }
        if ($this->discardPile->peekLastCard()->matches($card) || $card->getSymbol() === Card::COLOR_CHANGER) {
            $this->choosenColor = ($card->getSymbol() === Card::COLOR_CHANGER);

            $this->discardPile->addCard($card);
            $this->players[$this->currentPlayer]->playCard($card);
        } else {
            throw new Exception("Non-playable card");
        }
    }

    public function drawCard() {
        $drawnCard = $this->drawPile->drawCard();
        $this->players[$this->currentPlayer]->addCard($drawnCard);

        return $drawnCard;
    }

    public function nextTurn() {
        $this->reverseTurn = !$this->reverseTurn;
        $this->switchTurn();
    }
}