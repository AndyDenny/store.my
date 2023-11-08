<?php
define('VG_ACCESS', true);

header('Content-type: text/html;charset=utf-8');
session_start();

require_once 'config.php';
require_once 'core/base/settings/internal_settings.php';
require_once 'libraries/functions.php';

use core\base\controllers\RouteController;
use core\base\exceptions\RouteException;

try {
    RouteController::getInstance();//->route();

} catch (Exception $e){
    exit($e->getMessage());

}
