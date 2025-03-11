<?php
declare(strict_types=1);
// ini_set('display_errors', true);
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

require 'routes.php';
