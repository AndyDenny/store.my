<?php


namespace core\base\settings;


class Settings
{
    static private $_instance;

    private $routes = [
        'admin' => [
            'name' => 'admin',
            'path' => 'core/admin/controller/',
            'hrUrl' => false,
        ],
        'settings' => [
            'path' => 'core/base/settings/'
        ],
        'plugins' => [
            'path' => 'core/plugins/',
            'hrUrl' => false,
        ],
        'user' => [
            'path' => 'core/user/controller/',
            'hrUrl' => true,
            'routes' => [

            ],
        ],
        'default' => [
            'controller' => 'IndexController',
            'inputMethod' => 'inputData',
            'outputMethod' => 'outputData'
        ]
    ];

    private $templateArr = [
        'text' => ['name', 'phone','address'],
        'textarea' => ['content', 'keywords']
    ];

    private function __construct(){

    }

    private function __clone(){

    }

    static public function get($property){
        return self::getInstance()->$property;
    }

    static public function getInstance(){
        if(self::$_instance instanceof self){
            return self::$_instance;
        }
        return self::$_instance = new self;
    }

    public function glueProperties($class){
        $base_properties = [];
        foreach ($this as $name => $item) {
            $property = $class::get($name);
            $base_properties[$name] = $property;
        }
        pre($base_properties);
        exit();
    }


}