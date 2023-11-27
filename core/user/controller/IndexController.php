<?php

namespace core\user\controller;

use core\base\controller\BaseController;

class IndexController extends BaseController
{

//    protected function hello(){
//        $template = $this->render(false, ['name' => 'Masha']);
//        exit($template);
//    }

    protected $name;

    protected function inputData(){
        $name = 'Maashsa';
        $surname = 'Ivanova';
        $this->name = 'Sergey';

        return compact('name','surname');

    }
    protected function outputData(){
        $vars = func_get_arg(0);
        exit($this->render(false,$vars));
    }


}