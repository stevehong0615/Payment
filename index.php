<?php

header('Content-Type: text/html; charset=utf-8');

session_start();

require_once 'core/Connect.php';
require_once 'core/App.php';
require_once 'core/Controller.php';

$app = new App();