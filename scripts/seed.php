<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Database;
use App\Schema;
use App\Seeder;

$pdo = Database::connection();
Schema::ensure($pdo);

$seeder = new Seeder($pdo);
$seeder->run();
