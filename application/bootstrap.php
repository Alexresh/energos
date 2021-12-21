<?php
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';
require_once 'core/context.php';
require_once 'models/item.php';
require_once 'models/brand.php';
session_start();
Route::start(); // запускаем маршрутизатор
?>