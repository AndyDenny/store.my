<?php


namespace core\base\settings;


use core\base\controller\Singleton;

class Settings
{

    use Singleton;

    private $routes = [
        'admin' => [
            'alias' => 'admin',
            'path' => 'core/admin/controller/',
            'hrUrl' => false,
            'routes' => [

            ]
        ],
        'settings' => [
            'path' => 'core/base/settings/'
        ],
        'plugins' => [
            'path' => 'core/plugins/',
            'hrUrl' => false,
            'dir' => false,
        ],
        'user' => [
            'path' => 'core/user/controller/',
            'hrUrl' => true,
            'routes' => [
                //'site' => 'index/hello'
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

    static public function get($property){
        return self::instance()->$property;
    }

    public function glueProperties($class){
        $base_props = [];

        foreach ($this as $name => $item) {
            $property = $class::get($name);

            if (is_array($property) && is_array($item)){

                $base_props[$name] = $this->arrayMergeRecursive($this->$name, $property);
                continue;
            }
            if (!$property) $base_props[$name] = $this->$name;
        }
        return $base_props;
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