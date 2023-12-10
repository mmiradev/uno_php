<?php


class Card implements \Countable
{
    //const
    const BLUE = 0;
    const GREEN = 1;
    const RED = 2;
    const YELLOW = 3;
    const BLACK = 4;

    const PICKER = 10;
    const REVERSE = 11;
    const SKIP = 12;
    const COLOR_CHANGER = 13;
    const PICK_FOUR = 14;

    //atributes
    private int $color;
    private int $symbol;
    private static int $totalCards = 0;

    //Constructor
    public function __construct(int $color, int $symbol)
    {
        if (empty($color) || empty($symbol)) {

        }
        if ($color < 0 || $color > 4){
            throw new Exception("Invalid color");
        }
        if ($symbol < 0 || $symbol > 15){
            throw new Exception("Invalid symbol");
        }
        $this->color = $color;
        $this->symbol = $symbol;
        self::$totalCards++;
    }

    //getters
    public function getColor(): int
    {
        return $this->color;
    }

    public function getSymbol(): int
    {
        return $this->symbol;
    }

    public function getImage(): string
    {
        return "images/$this->color" . "_" . "$this->symbol.png";
    }

    //methods and functions
    public function matches(Card $card): bool
    {
        if (empty($card)) throw new Exception("Invalid card - cannot be empty!");
        if ($this->getColor() == $card->getColor() && $this->getSymbol() == $card->getSymbol()) return true;
        return false;
    }

    public function getPoints() : int
    {
        switch ($this->getSymbol()) {
            case self::PICKER || self::REVERSE || self::SKIP:
                return 20;
            case self::COLOR_CHANGER || self::PICK_FOUR:
                return 50;
            default:
                return $this->getSymbol();
        }
    }

    public function __toString(): string{
        return $this->getColor(). " ". $this->getSymbol();
    }

    public function count(): int
    {
        return self::$totalCards;
    }
}