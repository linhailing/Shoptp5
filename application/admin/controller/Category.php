<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2018/4/6
 * Time: 14:30
 */
namespace app\admin\controller;
use think\Controller;
use app\common\model\GoodsClass;

class Category extends Controller{
    public function index(){
        $goodsClass = new GoodsClass();
        $count = $goodsClass->getCount();
        return $this->fetch('index',
            [
                'count'=>$count
            ]);
    }
    public function category_add(){
        $goodsClass = new GoodsClass();
        $data = [];
        $ok_url = $this->request->domain().url('category/index');
        if ($this->request->isPost()){
            $gc_name = $this->request->post('gc_name', '');
            $gc_pid = $this->request->post('gc_pid', 0,'intval');
            $data['gc_name'] = $gc_name;
            $data['gc_pid'] = $gc_pid;
            $res = $goodsClass->add($data);
            if ($res){
                echo "<script language=javascript>alert('添加成功！');self.location='".$ok_url."';</script>";
                return;
            }else{
                echo "<script language=javascript>alert('添加失败！');window.history.back(-1);</script>";
                return;
            }
            exit;
        }
        $data = $goodsClass->getTree();
        return $this->fetch('category_add',[
            'data'=>$data
        ]);
    }
    public function get_list_ajsx(){
        $fields = 'id,gc_pid as pid,gc_name as name';
        $goodsClass = new GoodsClass();
        $data = $goodsClass->getList($fields);
        echo json_encode($data, true);
    }
}