<?php

namespace App\Services;

use App\Models\UserLink;

class LotteryService
{
    private const TIERS = [
        ['max' => 300,  'multiplier' => 0.1],
        ['max' => 600,  'multiplier' => 0.3],
        ['max' => 900,  'multiplier' => 0.5],
        ['max' => 1000, 'multiplier' => 0.7],
    ];

    public function playLotteryGame(UserLink $userLink) : float
    {
        $score  = rand(0, 1000);
        $win    = $score % 2 === 0;

        if ($win) {
            return $this->calculateIncome($score);
        }

        return 0.00;
    }

    /**
     * Calculates the income based on the given score and predefined tiers.
     *
     * @param int $score The score used to determine the income.
     * @return float The calculated income, rounded to two decimal places.
     */
    private function calculateIncome(int $score) : float
    {
        $income = 0.00;

        foreach (self::TIERS as $tier) {

            if ($score <= $tier['max']) {
                $income = $score * $tier['multiplier'];

                break;
            }
        }

        return round($income, 2);
    }
}
