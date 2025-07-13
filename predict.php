#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

// Uncomment this to see the tests pass for one of the completed implementations (A, B, or C)
// use App\Services\PointsServiceCompleteA as PointsService; 
// use App\ValueObjects\ScorelineCompleteA as Scoreline;

// Comment this out if you are running tests against one of the completed implementations (A, B, or C)
use App\Services\PointsService; 
use App\ValueObjects\Scoreline;

// Example usage:
// php predict.php 2-1 1-0

if ($argc !== 3) {
    echo "Usage: php predict.php <predicted-score> <actual-score>\n";
    echo "Example: php predict.php 2-1 1-0\n";
    exit(1);
}

try {
    $predicted = Scoreline::from($argv[1]);
    $actual = Scoreline::from($argv[2]);

    $points = (new PointsService())->calculate($predicted, $actual);

    echo "Points awarded: {$points}\n";
} catch (Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(2);
}
