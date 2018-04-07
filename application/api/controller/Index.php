<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2018/4/5
 * Time: 17:19
 */
namespace app\api\controller;
class Index{
    public  function index(){
        $data = [
            'name'=>'text',
            'id'=>100
        ];
        return $data;
    }
    public function getconfig(){
        return config();
    }
}