<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2018/4/6
 * Time: 13:16
 */
namespace app\admin\controller;
use think\Controller;

class Index extends Controller{
    public function index(){
        return $this->fetch();
    }
}