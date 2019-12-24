<?php

namespace app\admin\controller;

use app\api\logic\ExcelLogic;
use app\common\controller\Backend;
use EasyWeChat\Support\File;


/**
 * 试卷管理管理
 *
 * @icon fa fa-circle-o
 */
class WkExam extends Backend
{
    CONST title = [
        'question_index' => '题号',
        'question' => '问题',
        'answer' => '答案',
        'explain' => '解析',
        'question_type' => '类型',
        'import_count' => '重要指数',
        'score' => '分值',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ];
    
    /**
     * WkExam模型对象
     * @var \app\admin\model\WkExam
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\WkExam;
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */

    /**
     * 查看
     */
    public function index()
    {
        //当前是否为关联查询
        $this->relationSearch = true;
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax())
        {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField'))
            {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                    ->with(['wksubject'])
                    ->where($where)
                    ->order($sort, $order)
                    ->count();

            $list = $this->model
                    ->with(['wksubject'])
                    ->where($where)
                    ->order($sort, $order)
                    ->limit($offset, $limit)
                    ->select();

            foreach ($list as $row) {
                
                
            }
            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }

    public function add()
    {
        $subjectOptions = \app\admin\model\WkSubject::getOptions();
        $this->assign('subjectOptions',$subjectOptions);
        return parent::add();
    }

    public function edit($ids = null)
    {
        $subjectOptions = \app\admin\model\WkSubject::getOptions();
        $this->assign('subjectOptions',$subjectOptions);
        return parent::edit($ids);
    }


    //获取默认的excel模板
    public function default_excel(){
        $req = request()->param(false);
        $ids = $req['ids'] ?$req['ids']: 0;  //试卷id
        $row = \app\admin\model\WkExam::where('id',$ids)->find();
        $excel = new ExcelLogic();
        $data = [
            [
                'question_index'  => "1",
                'question' => '1+1=?',
                'answer' => 'B',
                'explain' => '答错的请出门右拐！',
                'question_type' => '1单选 2多选 3填空 4简答',
                'import_count' => '重要指数1-100',
                'A' => '1[只有一个答案填在这列]',
                'B' => '2',
                'C' => '3',
                'D' => '4',
            ]
        ];
        $map = [
            'title'=> self::title,
        ];
        $file = 'exam_' . date('YmdHis')."_".$row->id;
        $excel->export($data, $map, $file);
    }

    public function import(){
        $req = request()->param(false);
        $file = $this->request->file('file');

        $name = $req['name'];   //   exam_20191224165613_2.xlsx

        $baseinfo = (explode('.',$name))[0];
        $baseinfo_arr = explode('_',$baseinfo);
        if($baseinfo_arr[0] != 'exam'){
            return $this->error('非法文件');
        }
        $exam_id = $baseinfo_arr[2];

        if (!$file) {
            $this->error(__('Parameter %s can not be empty', 'file'));
        }

        $filePath = ROOT_PATH . 'public' . DS . 'uploads'.DS.'exam'.DS;

        $fileinfo = $file->getFileInfo();

        $move = $file->move($filePath);
        if($move){
            $fileFullName = $filePath . $move->getFilename();
//
            if (!is_file($fileFullName)) {
                $this->error(__('No results were found'));
            }
            $excel = new ExcelLogic();
            $data = $excel->import($fileFullName,self::title);

            @unlink($fileFullName);

            $insert_data = [];
            foreach ($data as $datum){
                $insert_data[] = [
                    'exam_id' => $exam_id,
                    'score' => $datum['score'],
                    'name' => $datum['question'],
                    'name_detail' => $datum['question'],
                    'answer' => $datum['answer'],
                    'explain' => $datum['explain'],
                    'question_type' => $datum['question_type'],
                    'question_index' => $datum['question_index'],
                    'import_count' => $datum['import_count'],
                    'createtime' => time(),
                    'A' => $datum['A'],
                    'B' => $datum['B'],
                    'C' => $datum['C'],
                    'D' => $datum['D'],
                ];
            }

            \app\admin\model\WkExamQuestion::where('exam_id',$exam_id)->delete();
            (new \app\admin\model\WkExamQuestion)->saveAll($insert_data);
        }

        return $this->success();
    }



}
