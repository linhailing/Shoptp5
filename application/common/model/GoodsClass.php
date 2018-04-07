<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2018/4/6
 * Time: 16:59
 */
namespace app\common\model;
use think\Exception;
use think\Model;
use think\Db;

class GoodsClass extends Model{
    protected $pk = 'id';
    protected $table = 'goods_class';
    public function add($data){
        $ret = true;
        if (!empty($data) && isset($data['gc_pid']) && $data['gc_pid'] == 0){
            Db::startTrans();
            try{
                //$lastInsertId = $this->add($data);
                $lastInsertId = Db::table('goods_class')->insertGetId($data);
                if(!$lastInsertId){
                    throw new Exception('数据添加失败');
                }
                $data = [];
                $data['gc_path'] = "0,".$lastInsertId;
                $data['gc_level'] = 1;
                if(!Db::table('goods_class')->where('id',$lastInsertId)->update($data)){
                    throw new Exception('数据修改失败');
                }
                Db::commit();
                $ret = true;
            }catch (\Exception $e){
                Db::rollback();
                $ret = false;
            }
        }else if(!empty($data) && isset($data['gc_pid']) && $data['gc_pid'] != 0){
            //$tran = $this->transaction();
            Db::startTrans();
            try{
                //$lastInsertId = $this->add($data);
                $lastInsertId = Db::table('goods_class')->insertGetId($data);
                if(!$lastInsertId){
                    throw new Exception('数据添加失败');
                }
                $res = $this->field('id,gc_path')->find($data['gc_pid']);
                $gc_path = empty($res) ? 0 : $res->gc_path;
                $data = [];
                $data['gc_path'] = $gc_path.",".$lastInsertId;
                $data['gc_level'] = substr_count($data['gc_path'], ',');
                if(!Db::table('goods_class')->where('id',$lastInsertId)->update($data)){
                    throw new Exception('数据修改失败');
                }
                Db::commit();
                $ret = true;
            }catch (\Exception $e){
                Db::rollback();
                $ret = false;
            }
        }else{
            $ret = false;
        }
        return $ret;
    }
    public function getCount(){
        return $this->count();
    }
    public function getAll(){

    }
    public function getList($field = null){
        $data = [];
        $data = $this->field($field)->select()->toArray();
        return $data;
    }
    public function getTree(){
        $res = [];
        $res = $this->field('*,CONCAT(gc_path,",") as gc_path')
            ->order('gc_path')
            ->select();
        if(!empty($res)){
            foreach ($res as $k=>$v){
                if($v['gc_level'] == 1){
                    $res[$k]['gc_name'] = "|--".$v['gc_name'];
                }else if($v['gc_level'] == 2){
                    $res[$k]['gc_name'] = "|--|--".$v['gc_name'];
                }else if($v['gc_level'] == 3){
                    $res[$k]['gc_name'] = "|--|--|--".$v['gc_name'];
                }else if($v['gc_level'] == 4){
                    $res[$k]['gc_name'] = "|--|--|--|--".$v['gc_name'];
                }
            }
        }
        return $res;
    }
}