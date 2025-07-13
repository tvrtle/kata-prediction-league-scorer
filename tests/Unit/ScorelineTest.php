<?php

// Uncomment this to see the tests pass for one of the completed implementations (A, B, or C)
use App\ValueObjects\ScorelineCompleteA as Scoreline;

// Comment this out if you are running tests against one of the completed implementations (A, B, or C)
// use App\ValueObjects\Scoreline;

test('can be created from array', function () {
    $scoreline = Scoreline::from([2, 1]);

    expect($scoreline->home)->toBe(2)
        ->and($scoreline->away)->toBe(1);
});

test('can be created from hyphen-separated string', function () {
    $scoreline = Scoreline::from('2-1');

    expect($scoreline->home)->toBe(2)
        ->and($scoreline->away)->toBe(1);
});

test('can be created from space-separated string', function () {
    $scoreline = Scoreline::from('2 1');

    expect($scoreline->home)->toBe(2)
        ->and($scoreline->away)->toBe(1);
});

test('can be created from colon-separated string', function () {
    $scoreline = Scoreline::from('2:1');

    expect($scoreline->home)->toBe(2)
        ->and($scoreline->away)->toBe(1);
});

test('throws on invalid array input', function () {
    Scoreline::from([1]); // only one value
})->throws(InvalidArgumentException::class);

test('throws on malformed string input', function () {
    Scoreline::from('hello-world');
})->throws(InvalidArgumentException::class);

test('isExactMatch returns true for identical scorelines', function () {
    $a = Scoreline::from('2-1');
    $b = Scoreline::from([2, 1]);

    expect($a->isExactMatch($b))->toBeTrue();
});

test('isExactMatch returns false for different scorelines', function () {
    $a = Scoreline::from('2-1');
    $b = Scoreline::from('1-2');

    expect($a->isExactMatch($b))->toBeFalse();
});

test('matchesResult returns true for same result type (draw)', function () {
    $a = Scoreline::from('1-1');
    $b = Scoreline::from('2-2');

    expect($a->matchesResult($b))->toBeTrue();
});

test('matchesResult returns true for same result type (home win)', function () {
    $a = Scoreline::from('3-1');
    $b = Scoreline::from('2-0');

    expect($a->matchesResult($b))->toBeTrue();
});

test('matchesResult returns false for different result types', function () {
    $a = Scoreline::from('2-1');
    $b = Scoreline::from('1-2');

    expect($a->matchesResult($b))->toBeFalse();
});

//
// Invalid array input
//
test('throws on array with only one element', function () {
    Scoreline::from([1]);
})->throws(InvalidArgumentException::class);

test('throws on array with too many elements', function () {
    Scoreline::from([1, 2, 3]);
})->throws(InvalidArgumentException::class);

test('throws on array with non-numeric values', function () {
    Scoreline::from(['one', 'two']);
})->throws(InvalidArgumentException::class);

//
// Malformed string input
//
test('throws on string with no separator', function () {
    Scoreline::from('1234');
})->throws(InvalidArgumentException::class);

test('throws on string with multiple separators', function () {
    Scoreline::from('1--2');
})->throws(InvalidArgumentException::class);

test('throws on malformed characters in string', function () {
    Scoreline::from('two-one');
})->throws(InvalidArgumentException::class);

//
// Invalid type
//
test('throws on completely invalid input type', function () {
    Scoreline::from(3.14);
})->throws(InvalidArgumentException::class);

