<?php

namespace App\Services;

use App\ValueObjects\ScorelineCompleteA as Scoreline;

final class PointsServiceCompleteA
{
    public function calculate(Scoreline $predicted, Scoreline $actual): int
    {
        if ($predicted->isExactMatch($actual)) {
            return 3;
        }

        if ($predicted->matchesResult($actual)) {
            return 1;
        }

        return 0;
    }
}
