<?php
declare(strict_types=1);


/* --------------------------------------------------------
   1. METHOD: REPLACE MAGIC NUMBER
--------------------------------------------------------- */

/*
 * Problem version (before refactoring)
 * Contains unclear “magic numbers” (0.95, 0.90, 1, 2)
 */
function calculateDiscount_before(float $price, int $customerType): float
{
    if ($customerType === 1) {
        return $price * 0.95; // 5% discount
    }

    if ($customerType === 2) {
        return $price * 0.90; // 10% discount
    }

    return $price;
}

/*
 * Refactored version (after refactoring)
 * Constants explain the purpose of each value.
 */
define('DISCOUNT_REGULAR', 0.95);
define('DISCOUNT_VIP', 0.90);
define('CUSTOMER_REGULAR', 1);
define('CUSTOMER_VIP', 2);

function calculateDiscount(float $price, int $customerType): float
{
    if ($customerType === CUSTOMER_REGULAR) {
        return $price * DISCOUNT_REGULAR;
    }

    if ($customerType === CUSTOMER_VIP) {
        return $price * DISCOUNT_VIP;
    }

    return $price;
}

/* --------------------------------------------------------
   2. METHOD: DECOMPOSE CONDITIONAL
--------------------------------------------------------- */

/*
 * Problem version (before refactoring)
 * Complex and nested conditional logic.
 */
function canUserAccess_before(array $user, array $resource): bool
{
    if ($user['is_active'] && ($user['role'] === 'admin' || $user['role'] === 'editor') && !$resource['is_locked']) {
        return true;
    }

    if ($user['is_active'] && $user['role'] === 'author' && $resource['owner_id'] === $user['id']) {
        return true;
    }

    return false;
}

/*
 * Refactored version (after refactoring)
 * Logic is decomposed into smaller, descriptive functions.
 */
function canUserAccess(array $user, array $resource): bool
{
    if (!isActive($user)) {
        return false;
    }

    if (isAdminOrEditor($user) && !isLocked($resource)) {
        return true;
    }

    if (isAuthorAndOwner($user, $resource)) {
        return true;
    }

    return false;
}

function isActive(array $user): bool
{
    return !empty($user['is_active']);
}

function isAdminOrEditor(array $user): bool
{
    return in_array($user['role'], ['admin', 'editor'], true);
}

function isLocked(array $resource): bool
{
    return !empty($resource['is_locked']);
}

function isAuthorAndOwner(array $user, array $resource): bool
{
    return $user['role'] === 'author' && ($resource['owner_id'] ?? null) === ($user['id'] ?? null);
}


/* --------------------------------------------------------
   3. METHOD: SUBSTITUTE ALGORITHM
--------------------------------------------------------- */

/*
 * Problem version (before refactoring)
 * Overcomplicated algorithm for finding common prefix.
 */
function commonPrefix_before(array $strings): string
{
    if (empty($strings)) {
        return '';
    }

    $prefix = $strings[0];
    $count = count($strings);

    for ($i = 1; $i < $count; $i++) {
        $s = $strings[$i];
        $j = 0;
        $newPrefix = '';
        while ($j < strlen($prefix) && $j < strlen($s)) {
            if ($prefix[$j] === $s[$j]) {
                $newPrefix .= $prefix[$j];
            } else {
                break;
            }
            $j++;
        }
        $prefix = $newPrefix;
        if ($prefix === '') {
            break;
        }
    }

    return $prefix;
}

/*
 * Refactored version (after refactoring)
 * Simplified using sorting and comparison of first & last elements.
 */
function commonPrefix(array $strings): string
{
    if (empty($strings)) {
        return '';
    }

    sort($strings, SORT_STRING);
    $first = $strings[0];
    $last = $strings[count($strings) - 1];
    $length = min(strlen($first), strlen($last));
    $i = 0;

    while ($i < $length && $first[$i] === $last[$i]) {
        $i++;
    }

    return substr($first, 0, $i);
}
