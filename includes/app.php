<?php


require 'funciones.php';
require 'config/db.php';
require __DIR__ . '/../vendor/autoload.php';




$db = connectDB();

use App\Services;
use App\Users;

Services::setDB($db);
Users::setDB($db);