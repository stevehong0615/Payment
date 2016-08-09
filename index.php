<?php

mb_internal_encoding('utf-8');

session_start();

require_once 'core/Connect.php';
require_once 'core/App.php';
require_once 'core/Controller.php';

$app = new App();