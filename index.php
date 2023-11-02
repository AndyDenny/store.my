<?php
define('VG_ACCESS', true);

use core\base\controllers\RouteController;

header('Content-type: text/html;charset=utf-8');
session_start();

require_once 'config.php';
require_once 'core/base/settings/internal_settings.php';

try {
    RouteController::getInstance();//->route();
}
catch (Exception $e){
    exit($e->getMessage());
}

