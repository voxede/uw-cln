<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../core/Router.php';
require_once '../core/BaseController.php';
require_once '../core/BaseModel.php';
require_once '../config/config.php';

$router = new Router();
