<?php
namespace app\api\controller;


use app\api\library\ResultCode;
use app\api\logic\WkLogic;
use app\common\controller\Api;
use think\Request;


/**
 * 接口
 */
class Wk extends Api{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';

    protected $logic;

    public function __construct(Request $request = null)
    {

        parent::__construct($request);
        $this->logic = new WkLogic();

    }

    // 获取课程列表
    public function subject_list(){

        $req = request()->param(false);
        $res = $this->logic->subject_list($req,1,100);
        return  ResultCode::SUCCESS('ok',$res);
    }

    public function exam_list(){
        $req = request()->param(false);
        $pageindex = $req['page_index'] ?? 1;
        $eachpage = $req['each_page'] ?? 10;
        $res = $this->logic->exam_list($req,$pageindex,$eachpage);
        return  ResultCode::SUCCESS('ok',$res);
    }

    public function exam_info(){
        $req = request()->param(false);
        $res = $this->logic->exam_info($req);
        return  ResultCode::SUCCESS('ok',$res);
    }

    public function each_question(){
        $req = request()->param(false);
        $res = $this->logic->each_question($req);
        return  ResultCode::SUCCESS('ok',$res);
    }

    public function do_answer(){
        $req = request()->param(false);
        $res = $this->logic->do_answer($req);
        return  ResultCode::SUCCESS('ok',$res);
    }

    public function total_score(){
        $req = request()->param(false);
        $res = $this->logic->total_score($req);
        return  ResultCode::SUCCESS('ok',$res);
    }

    public function do_like(){
        $req = request()->param(false);
        $res = $this->logic->do_like($req);
        return  ResultCode::SUCCESS('ok',$res);
    }

    public function do_history(){
        $req = request()->param(false);
        $res = $this->logic->do_history($req);
        return  ResultCode::SUCCESS('ok',$res);
    }



}

