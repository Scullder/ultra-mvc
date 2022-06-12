<?php
session_start();
require_once '../vendor/autoload.php';
echo Core\Route::call_action();
