<?php

namespace App\Services;

use App\ValueObjects\ScorelineCompleteC as Scoreline;

final class PointsServiceCompleteC
{
    public function calculate(Scoreline $predicted, Scoreline $actual): int
    {
        if ($predicted->home === $actual->home && $predicted->away === $actual->away) {
            return 3;
        }

        if (
            ($predicted->home > $predicted->away && $actual->home > $actual->away) ||  // home win
            ($predicted->home < $predicted->away && $actual->home < $actual->away) ||  // away win
            ($predicted->home === $predicted->away && $actual->home === $actual->away) // draw
        ) {
            return 1;
        }

        return 0;
    }
}
