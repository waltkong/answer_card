<?php

namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class WkSubject extends Model
{

    use SoftDelete;

    

    // 表名
    protected $name = 'wk_subject';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = 'deletetime';

    // 追加属性
    protected $append = [

    ];



    public static function getOptions(){
        $list = self::order("sort", 'desc')->limit(0, 500)->select();
        $list = collection($list)->toArray();
        $ret = [];
        foreach ($list as $k => $v){
            $ret[$v['id']] = $v['name'];
        }
        return $ret;
    }






}
