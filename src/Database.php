<?php

declare(strict_types=1);

namespace App;

use PDO;

final class Database
{
    public static function connection(): PDO
    {
        static $pdo = null;

        if ($pdo instanceof PDO) {
            return $pdo;
        }

        $dsn = 'mysql:host=mysql;port=3306;dbname=app;charset=utf8mb4';
        $pdo = new PDO($dsn, 'app', 'app', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
        ]);

        return $pdo;
    }
}
