<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2018/4/6
 * Time: 21:59
 */
namespace app\common\model;
use think\Model;
use think\Db;

class BrandModel extends Model{
    protected $pk = 'id';
    protected $table = "brand";
    public function _add($data = []){
        if (empty($data)){
            return false;
        }
        $data['create_at'] = time();
        $data['update_at'] = time();
        return Db::table($this->table)->insertGetId($data);
    }
    public function _update($data = [], $where = []){
        if (empty($where)){
            return false;
        }
        $data['update_at'] = time();
        return Db::table($this->table)->where($where)->update($data);
    }
    public function _getAll(){
        return Db::table($this->table)->order('b_sort', 'desc')->select();
    }
    public function _getCount(){
        return Db::table($this->table)->count();
    }
}