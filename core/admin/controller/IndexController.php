<?php


namespace core\admin\controller;


use core\base\controller\BaseController;
use core\admin\model\Model;

class IndexController extends BaseController
{

    protected function inputData(){

        $db = Model::instance();

//        $table = '';
//
//        $res = $db->get($table,[
//            'fields'=>['id','name'],
//            'where' => ['id' => 1, 'name' => 'Masha'],
//            'operand' => ['=','<>'],
//            'condition' => ['AND'],
//            'order' => ['fio','name'],
//            'order_direction' => ['ACS','DESC'],
//            'limit' => '1',
//        ]);

        exit('ADMIN PANEL');
    }

}