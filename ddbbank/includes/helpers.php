<?php
declare(strict_types=1);

// Escape dynamic text before it is inserted into HTML to prevent markup supplied by a visitor from being executed.
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function money(float|string $value): string
{
    return '$' . number_format((float) $value, 2);
}

// Display only the final four digits of a fictional account number in the portal interface.
function mask_account(string $number): string
{
    $lastFour = substr(preg_replace('/\D/', '', $number), -4);
    return '•••• •••• ' . $lastFour;
}

function date_label(string $date): string
{
    return date('M j, Y', strtotime($date));
}

function account_badge_class(string $type): string
{
    return strtolower(str_replace(' ', '-', $type));
}

function active_link(string $file, string $current): string
{
    return $file === $current ? 'aria-current="page"' : '';
}
