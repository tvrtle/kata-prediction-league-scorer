<?php

// Uncomment this to see the tests pass for one of the completed implementations (A, B, or C)
use App\Services\PointsServiceCompleteA as PointsService; 
use App\ValueObjects\ScorelineCompleteA as Scoreline;

// Comment this out if you are running tests against one of the completed implementations (A, B, or C)
// use App\Services\PointsService; 
// use App\ValueObjects\Scoreline;

beforeEach(function () {
    $this->service = new PointsService();
});

test('awards 3 points for exact score match', function () {
    $predicted = Scoreline::from('2-1');
    $actual = Scoreline::from('2-1');

    expect($this->service->calculate($predicted, $actual))->toBe(3);
});

test('awards 1 point for correct result (draw)', function () {
    $predicted = Scoreline::from('1-1');
    $actual = Scoreline::from('2-2');

    expect($this->service->calculate($predicted, $actual))->toBe(1);
});

test('awards 1 point for correct result (home win)', function () {
    $predicted = Scoreline::from('3-0');
    $actual = Scoreline::from('1-0');

    expect($this->service->calculate($predicted, $actual))->toBe(1);
});

test('awards 1 point for correct result (away win)', function () {
    $predicted = Scoreline::from('0-2');
    $actual = Scoreline::from('1-3');

    expect($this->service->calculate($predicted, $actual))->toBe(1);
});

test('awards 0 points for completely incorrect prediction', function () {
    $predicted = Scoreline::from('2-1');
    $actual = Scoreline::from('0-2');

    expect($this->service->calculate($predicted, $actual))->toBe(0);
});

test('awards 3 points for exact 0-0 draw', function () {
    $service = new PointsService();
    $points = $service->calculate(
        Scoreline::from('0-0'),
        Scoreline::from('0-0')
    );

    expect($points)->toBe(3);
});

test('awards 1 point for correct result with different draw score', function () {
    $service = new PointsService();
    $points = $service->calculate(
        Scoreline::from('2-2'),
        Scoreline::from('0-0')
    );

    expect($points)->toBe(1);
});

test('awards 0 points for predicting draw but actual is win', function () {
    $service = new PointsService();
    $points = $service->calculate(
        Scoreline::from('0-0'),
        Scoreline::from('1-0')
    );

    expect($points)->toBe(0);
});

test('awards 3 points for low-scoring home win', function () {
    $service = new PointsService();
    $points = $service->calculate(
        Scoreline::from('1-0'),
        Scoreline::from('1-0')
    );

    expect($points)->toBe(3);
});
