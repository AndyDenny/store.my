<?php
defined('VG_ACCESS') or die('Access denied');

use core\base\exceptions\RouteException;


const TEMPLATE = 'template/default/';
const ADMIN_TEMPLATE = 'core/admin/view/';

const COOKIE_VERSION = '1.0.0';
const CRYPT_KEY =  '';
const COOKIE_TIME = 60;
const BLOCK_TIME = 3;

const QTY = 8;
const QTY_LINKS = 3;

const ADMIN_CSS_JS = [
    'styles' => [],
    'scripts' => []
];

const USER_CSS_JS = [
    'styles' => [],
    'scripts' => []
];

//

function autoloadMainClasses($class_name){
    $class_name = str_replace('\\', '/', $class_name);
    if (!include_once $class_name . '.php' ){ // @ - игнорирование ошибок
        throw new RouteException('Не верное имя файла для подключения - '. $class_name);
    }
}


spl_autoload_register('autoloadMainClasses');