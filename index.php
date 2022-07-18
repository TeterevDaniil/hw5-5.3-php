<?php

use Base\Application;
use Base\Route;

include './vendor/autoload.php';
include './src/config.php';
include './src/eloquent.php';

$app = new Application();
$app->run();

