<?php

namespace Transformers\Classes;

class Transformer
{
    private $id;
    private $name;
    private $size;
    private $speed;
    private $power;
    private $disguise;
    private $top_trumps_rating;
    private $type;
    private $img_url;
    private $wins;
    private $played;

    public function getWinRatio(): int
    {
        if ($this->played == 0) {
            return 0;
        } else {
            return ($this->wins / $this->played) * 100;
        }
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Get the value of speed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Get the value of power
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * Get the value of disguise
     */
    public function getDisguise()
    {
        return $this->disguise;
    }

    /**
     * Get the value of top_trumps_rating
     */
    public function getTop_trumps_rating()
    {
        return $this->top_trumps_rating;
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the value of img_url
     */
    public function getImg_url()
    {
        return $this->img_url;
    }

    /**
     * Get the value of wins
     */
    public function getWins()
    {
        return $this->wins;
    }

    /**
     * Get the value of played
     */
    public function getPlayed()
    {
        return $this->played;
    }

    public static function winRatioForEach(array $transformers): array
    {
        $result = [];
        foreach ($transformers as $transformer) {
            $win = $transformer->getWinRatio();
            $result[$transformer->getName()] = $win;
        }
        return $result;
    }

    public static function randomTransformers(array $transformers): array
    {
        if (count($transformers)) {
            shuffle($transformers);
            $result = [$transformers[0], $transformers[1]];
            return $result;
        } else {
            return [];
        }
    }

    public static function pickWinner($transformer1, $transformer2)
    {
        $result = '';
        $sum = $transformer1->getWinRatio() - $transformer2->getWinRatio();
        if ($sum > 0) {
            $result = $transformer1;
        } elseif ($sum < 0) {
            $result = $transformer2;
        } else {
            $result = 'Its a draw';
        }
        return $result;
    }
}
