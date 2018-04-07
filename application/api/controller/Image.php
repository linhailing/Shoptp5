<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2018/4/7
 * Time: 14:36
 */
namespace app\api\controller;
use think\Controller;

class Image extends Controller{
    /**
     * 上传图片
     */
    public  function upload(){
        $file = $this->request->file('file');
        //文件上传目录
        $info = $file->move('upload');
        $data = [];
        if ($info && $info->getPathname()){
            $data['file_url'] = '\\'.$info->getPathname();
            $data['file_name'] = $info->getFilename();
            return ['code'=>200,'msg'=>'ok', 'data'=>$data];
        }
        return ['code'=>404,'msg'=>'error', 'data'=>[]];
    }
}