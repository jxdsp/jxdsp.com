<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__), 'env/.env');
$dotenv->load();
