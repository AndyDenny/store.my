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
        $base_props = [];
        foreach ($this as $name => $item) {
            $property = $class::get($name);

            if (is_array($property) && is_array($item)){
                $base_props[$name] = $this->arrayMergeRecursive($this->$name, $property);
            }
        }
        pre($base_props);
        exit();
    }

    public function arrayMergeRecursive(){
        $arrays = func_get_args();

        $base = array_shift($arrays);

        foreach ($arrays as $array){
            foreach ($array as $key => $value){
                if(is_array($value) && is_array($base[$key])){
                    $base[$key] = $this->arrayMergeRecursive($base[$key],$value);
                }else{
                    if(is_int($key)){
                        if(!in_array($value,$base)) array_push($base, $value);
                        continue;
                    }
                    $base[$key] = $value;
                }
            }
        }
        return $base;

    }

}