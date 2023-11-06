<?php


namespace core\base\settings;

use core\base\settings\Settings;

class ShopSettings
{

    static private $_instance;

    private $base_settings;

    private $templateArr = [
        'text' => ['name', 'phone','address', 'price'],
        'textarea' => ['content', 'keywords', 'goods_content']
    ];


    static public function get($property){
        return self::getInstance()->$property;
    }

    static public function getInstance(){
        if(self::$_instance instanceof self){
            return self::$_instance;
        }

        self::$_instance = new self;
        self::$_instance->base_settings = Settings::getInstance();
        $base_properties = self::$_instance->base_settings->glueProperties(get_class());
        return self::$_instance;
    }

    private function __construct(){

    }

    private function __clone(){

    }
}