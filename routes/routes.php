<?php
use Core\Route;

// аторизация пользоателя
Route::add('/', function(){ echo "Hello there!"; });
Route::add('/ajax/test', ['AjaxController', 'test']);
