# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

An unofficial PHP 8.2+ HTTP API client library for the Trading212 stock trading platform. Published as `marekskopal/trading212` via Composer.

## Commands

```bash
# Tests
php vendor/bin/phpunit

# Static analysis (level 9)
php vendor/bin/phpstan

# Code style
php vendor/bin/phpcs

# Run a single test file
php vendor/bin/phpunit tests/Api/PiesTest.php
```

## Architecture

**Entry point:** `src/Trading212.php` — readonly facade class that instantiates all API modules and exposes them via getters.

**Layers:**

- `src/Api/` — Six API endpoint classes (`AccountData`, `EquityOrders`, `HistoricalItems`, `InstrumentsMetadata`, `PersonalPortfolio`, `Pies`), all extending `Trading212Api` abstract base
- `src/Client/` — `Client` (PSR-18) handles GET/POST/DELETE, rate-limit retry logic, and live/demo base URI selection
- `src/Config/` — `Config` readonly class: API key, demo flag, retry settings
- `src/Dto/` — Readonly DTOs organized by domain; all have static `fromJson()` / `fromArray()` factory methods; `Pagination<T>` is a typed wrapper for paginated responses
- `src/Enum/` — Backed enums used throughout (`OrderStatusEnum`, `OrderTypeEnum`, `TimeValidityEnum`, etc.)
- `src/Exception/` — `ApiException::fromCode()` factory maps HTTP status codes to typed exceptions (400/401/404/408/429/500)
- `src/Utils/` — `DateTimeUtils` for Zulu/ISO8601 formatting

**Key patterns:**
- All domain classes are `readonly` (immutability enforced)
- PHPStan level 9 — no dynamic typing, strict generics
- PSR-7/17/18 for HTTP; `php-http/discovery` auto-discovers client implementations
- Rate limit (429) triggers automatic retry with configurable wait

## Code Standards

- PSR-12 + Slevomat coding standard (`ruleset.xml`)
- PHP 8.2 minimum; use enums, readonly, match expressions
- DTOs must be readonly classes with static `fromArray(array $data)` and `fromJson(string $json)` constructors
- New HTTP status codes must be added to `ApiException::fromCode()`
