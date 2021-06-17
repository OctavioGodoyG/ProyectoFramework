<?php
require_once __DIR__. '/vendor/autoload.php';

use app\core\Application;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$config = [
    'db' => [
        'dsn'=> $_ENV['dns'],
        'user'=> $_ENV['user'],
        'password'=> $_ENV['password'],
    ]
];
$app = new Application(__DIR__, $config);
$app->$db->applyMigrations();