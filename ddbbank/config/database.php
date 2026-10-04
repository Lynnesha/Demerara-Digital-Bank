<?php
declare(strict_types=1);

// Return one reusable PDO connection per request so every page shares consistent database settings.
function db(): PDO
{
    static $connection = null;

    if ($connection instanceof PDO) {
        return $connection;
    }

    // Environment variables allow local connection details to change without editing application code.
    $host = getenv('DDB_DB_HOST') ?: '127.0.0.1';
    $port = getenv('DDB_DB_PORT') ?: '3306';
    $name = getenv('DDB_DB_NAME') ?: 'ddb_bank';
    $user = getenv('DDB_DB_USER') ?: 'ddb_app';
    $password = getenv('DDB_DB_PASSWORD') ?: 'ddb_demo_2026';

    $connection = new PDO(
        "mysql:host={$host};port={$port};dbname={$name};charset=utf8mb4",
        $user,
        $password,
        [
            // Throw exceptions for controlled error handling and use native prepared statements for input safety.
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );

    return $connection;
}
