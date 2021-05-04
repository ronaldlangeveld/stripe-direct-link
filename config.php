<?php

require_once('vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$STRIPE_SECRET = $_ENV['STRIPE_SECRET'];
$STRIPE_PUBLISHABLE_KEY = $_ENV['STRIPE_PUBLISHABLE_KEY'];
$WEB_URL = $_ENV['WEB_URL'];


?>