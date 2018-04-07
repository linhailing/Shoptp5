<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2018/4/6
 * Time: 13:46
 */
namespace app\admin\controller;
use think\Controller;

class Welcome extends Controller{
    public function index(){
        return $this->fetch();
    }
}