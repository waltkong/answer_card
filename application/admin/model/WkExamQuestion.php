<?php

namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class WkExamQuestion extends Model
{

    use SoftDelete;

    

    // 表名
    protected $name = 'wk_exam_question';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = 'deletetime';

    // 追加属性
    protected $append = [

    ];
    

    







    public function wkexam()
    {
        return $this->belongsTo('WkExam', 'exam_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
