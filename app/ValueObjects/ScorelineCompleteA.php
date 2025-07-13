<?php

namespace App\ValueObjects;

use InvalidArgumentException;

final class ScorelineCompleteA
{
    public function __construct(
        public readonly int $home,
        public readonly int $away
    ) {}

    public static function from(mixed $input): self
    {
        if (is_array($input) && count($input) === 2) {
            if (!is_numeric($input[0]) || !is_numeric($input[1])) {
                throw new InvalidArgumentException("Scoreline array must contain two numeric values");
            }

            return new self((int) $input[0], (int) $input[1]);
        }

        if (is_string($input)) {
            if (preg_match('/^(\d+)[\s\-:](\d+)$/', $input, $matches)) {
                return new self((int) $matches[1], (int) $matches[2]);
            }

            throw new InvalidArgumentException("Invalid scoreline format: {$input}");
        }

        throw new InvalidArgumentException("Invalid scoreline input");
    }


    public function isExactMatch(self $other): bool
    {
        return $this->home === $other->home && $this->away === $other->away;
    }

    public function result(): string
    {
        return match (true) {
            $this->home > $this->away => 'home',
            $this->away > $this->home => 'away',
            default => 'draw',
        };
    }

    public function matchesResult(self $other): bool
    {
        return $this->result() === $other->result();
    }
}
