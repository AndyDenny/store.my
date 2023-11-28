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

        $name = 'Ivan';
        $content = $this->render('',compact('name'));
        $header = $this->render(TEMPLATE.'header');
        $footer = $this->render(TEMPLATE.'footer');

        return compact('header','content', 'footer');
    }

}