<?php

namespace Transformers\ViewHelpers;

use Transformers\Classes\Transformer;

class Display
{
    public static function displayTopTrumps(array $topTrumps): string
    {
        $result = '';
        foreach ($topTrumps as $topTrump) {
            if ($topTrump instanceof Transformer) {
                $result .= '<div class="card col-3 d-flex justify-content-center text-center"><h1 class="card-title">' . $topTrump->getName() . '</h1>';
                $result .= '<img style="max-height: 250" class="rounded-start card-img-top" src="' . $topTrump->getImg_url() . '">';
                $result .= '<p>Size: ' . $topTrump->getSize() . ' Speed: ' . $topTrump->getSpeed() . '</p>';
                $result .= '<p>Power: ' . $topTrump->getPower() . ' Disguise: ' . $topTrump->getDisguise() . '</p>';
                $result .= '<p>Rating: ' . $topTrump->getTop_trumps_rating() . ' Type: ' . $topTrump->getType() . '</p>';
                $result .= '<p>Wins: ' . $topTrump->getWins() . ' Played: ' . $topTrump->getPlayed() . '</p>';
                $result .= "<form method='post' action='verify.php'><input type='hidden' name='id' value=" . $topTrump->getId() . ">";
                $result .= "<input type='hidden' name='wins' value=" . $topTrump->getWins() . ">";
                $result .= "<button class='btn btn-secondary' type='submit'>Click to win!</button></form></div>";
            }
        }
        return $result;
    }

    public static function displayLeaderboard(array $leaders): string
    {
        $result = '';
        foreach ($leaders as $name => $score) {
            $result .= '<div class=\'container d-flex justify-content-center\'>';
            $result .= '<p><span class=\'fw-semibold\'>' . $name . '  </span>';
            $result .= ' Win Ratio: ' . $score . '</div>';
        }
        return $result;
    }

    public static function getOptionList($transformers)
    {
        $result = '';
        foreach ($transformers as $transformer) {
            $result .= '<option>' . $transformer->getName() . '</option>';
        }
        return $result;
    }
}
