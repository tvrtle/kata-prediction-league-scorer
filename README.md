# Prediction League Scorer Kata

A simple, test-driven PHP kata where you implement the logic for scoring football match predictions.

---

## 📝 Project Brief

Your task is to build a minimal scoring system for a football **prediction league**.

The league awards points as follows:

- ✅ **3 points** for an exact match (e.g. predicted `2-1` and result `2-1`, or predicted `2-2` and result `2-2`)
- ✅ **1 point** for a correct result (home win, away win, or draw) but incorrect score (e.g. predicted `1-0` and result `3-1`, or predicted `1-1` and result `2-2`)
- ❌ **0 points** for an incorrect result (e.g. predicted `1-0` and result `0-2`, or predicted `1-1` and result `2-1`)

The system should accept predictions and results, compare them, and return the appropriate number of points.

---

## 📦 Installation

```bash
git clone https://github.com/tvrtle/kata-prediction-league-scorer.git
cd kata-prediction-league-scorer
composer install
```

This project assumes you're running **PHP 8.2 or higher**.

---

## 🧪 Running the Tests

Run the tests using Pest:

```bash
./vendor/bin/pest
```

Or, if you've set up the Composer script:

```bash
composer test
```

### 🔄 Switching Implementations

The test suite is set up to work with three different approaches:

- **A** — Fully encapsulated value object logic
- **B** — Hybrid (split between Scoreline and PointsService)
- **C** — Minimal, logic-heavy service

To try each implementation, open `tests/Unit/PointsServiceTest.php` and `tests/Unit/ScorelineTest.php`, and **uncomment the relevant `use` statement**, e.g.:

```php
use App\ValueObjects\ScorelineCompleteA as Scoreline;
// or:
// use App\ValueObjects\ScorelineCompleteB as Scoreline;
// or:
// use App\ValueObjects\ScorelineCompleteC as Scoreline;
```

This lets you swap in different versions of the `Scoreline` and see how they each pass the same tests differently.

---

## ✅ What the Tests Cover

The test suite already includes:

### ✅ Core logic
- Exact score matches (3 points)
- Correct results (home win, away win, draw – 1 point)
- Completely incorrect predictions (0 points)

### ✅ Edge cases
- 0–0 draws
- Low and high scoring matches
- Incorrect result directions (e.g. predicted draw, actual win)

### ✅ Defensive input handling
- Invalid string formats
- Malformed arrays
- Non-numeric values
- Wrong input types (e.g. float, object)

---

## 🧠 Approaches to Take

You’re free to approach this however you like, but here are three common implementation styles you can study or imitate:

---

### ✳️ Version A – Full OOP / DDD-style

- `Scoreline` is a **rich value object**: it encapsulates parsing, comparison, and result logic
- `PointsService` delegates to methods like `isExactMatch()` and `matchesResult()`

**Pros:** Clean separation, easy to extend  
**Ideal for:** Practicing encapsulation, SRP, and value object patterns

---

### ✳️ Version B – Hybrid

- `Scoreline` handles parsing and `result()`  
- `PointsService` compares the raw values

**Pros:** Balanced and pragmatic  
**Ideal for:** Students learning to choose trade-offs between abstraction and simplicity

---

### ✳️ Version C – Procedural & Minimal

- `Scoreline` is just a dumb container with a `from()` method  
- All logic lives in `PointsService`

**Pros:** Easy to trace, minimal surface area  
**Ideal for:** Beginners or quick CLI utility logic

---

### 🛠️ Suggested Steps

1. Start with getting the **tests to pass** using the simplest approach
2. Refactor to introduce cleaner separation if desired
3. Explore versions A–C and compare trade-offs

---

## 🚀 Bonus

You can run the scorer from the command line like this:

```bash
php predict.php 2-1 1-0
```

Expected output:
```
Points awarded: 1
```

This uses `Scoreline::from()` to parse each score and runs the `PointsService`.

If you’ve added a Composer script like this:

```json
"scripts": {
  "predict": "php predict.php"
}
```

You can also run:

```bash
composer run predict -- 2-1 1-0
```

---

## 📁 Directory Structure

```text
.
├── app/                 → Source code (ValueObjects/Scoreline, Services/PointsService)
├── tests/               → Pest test suite
├── predict.php          → CLI entry point
├── composer.json
├── README.md
```

---

## 🧑‍🏫 Learning Goals

- Thinking in terms of **small composable classes**
- Practicing **defensive programming**
- Working with **typed input and test-driven design**
- Refactoring towards **cleaner, richer abstractions**

---

Happy scoring! ⚽
