<?php

namespace App\ValueObjects;

use InvalidArgumentException;

final class ScorelineCompleteC
{
    public function __construct(
        public int $home,
        public int $away
    ) {}

    public static function from(array|string $input): self
    {
        if (is_array($input)) {
            if (count($input) !== 2 || !is_numeric($input[0]) || !is_numeric($input[1])) {
                throw new InvalidArgumentException('Invalid scoreline array input.');
            }

            return new self((int) $input[0], (int) $input[1]);
        }

        if (is_string($input)) {
            $input = trim($input);

            if (preg_match('/^(\d+)[\s\-:](\d+)$/', $input, $matches)) {
                return new self((int) $matches[1], (int) $matches[2]);
            }

            throw new InvalidArgumentException("Invalid scoreline string input: '{$input}'");
        }

        throw new InvalidArgumentException('Invalid scoreline input type.');
    }

    public function isExactMatch(self $other): bool
    {
        return $this->home === $other->home && $this->away === $other->away;
    }

    public function matchesResult(self $other): bool
    {
        return $this->result() === $other->result();
    }

    public function result(): string
    {
        return match (true) {
            $this->home > $this->away => 'home',
            $this->away > $this->home => 'away',
            default => 'draw',
        };
    }
}
