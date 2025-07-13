<?php

namespace App\Services;

use App\ValueObjects\ScorelineCompleteB as Scoreline;

final class PointsServiceCompleteB
{
    public function calculate(Scoreline $predicted, Scoreline $actual): int
    {
        if ($predicted->home === $actual->home && $predicted->away === $actual->away) {
            return 3;
        }

        if ($this->result($predicted) === $this->result($actual)) {
            return 1;
        }

        return 0;
    }

    private function result(Scoreline $score): string
    {
        return match (true) {
            $score->home > $score->away => 'home',
            $score->away > $score->home => 'away',
            default => 'draw',
        };
    }
}
