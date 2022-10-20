<?php
error_reporting(E_ALL);
$dir = explode('\\', __DIR__);
array_pop($dir);
require join('\\', $dir) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once '../app/init.php';

$app = new App;
