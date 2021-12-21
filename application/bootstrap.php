<?php
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';
require_once 'core/context.php';
require_once 'models/item.php';
require_once 'models/brand.php';
require_once 'models/user.php';
require_once 'models/cart.php';
session_start();
Route::start(); // запускаем маршрутизатор
?>