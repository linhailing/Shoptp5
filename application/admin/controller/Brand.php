<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2018/4/6
 * Time: 20:36
 * 品牌管理
 */
namespace app\admin\controller;
use app\common\model\BrandModel;
use think\Controller;

class Brand extends Controller{
    public function index(){
        $brandModel = new BrandModel();
        $count = $brandModel->_getCount();
        return $this->fetch('index',[
            'count' => $count,
            'data' => $brandModel->_getAll()
        ]);
    }
    public function brand_add(){
        $data = [];
        $brandModel = new BrandModel();
        $ok_url = $this->request->domain().url('brand/index');
        if($this->request->isPost()){
            $data['b_name'] = $this->request->post('b_name','');
            $data['b_initial'] = $this->request->post('b_initial','A');
            $data['b_pic'] = $this->request->post('b_pic','');
            $data['b_sort'] = $this->request->post('b_sort',255);
            $data['b_desc'] = $this->request->post('b_desc','');
            if ($brandModel->_add($data)){
                echo "<script language=javascript>alert('添加成功！');self.location='".$ok_url."';</script>";
                return;
            }else{
                echo "<script language=javascript>alert('添加失败！');window.history.back(-1);</script>";
                return;
            }
            exit;
        }
        return $this->fetch('brand_add');
    }
    public function sent(){
        $res = \phpmailer\Email::send('462211958@qq.com','test email','hent to henry test email body...');
        if ($res){
            echo "邮件发送成功!";
        }else{
            echo "邮件发送失败！";
        }
    }
}