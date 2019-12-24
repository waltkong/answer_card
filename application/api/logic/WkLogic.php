<?php
namespace app\api\logic;
use app\admin\model\WkAnswerChoice;
use app\admin\model\WkExam;
use app\admin\model\WkExamQuestion;
use app\admin\model\WkMemberAnswers;
use app\admin\model\WkMemberHistory;
use app\admin\model\WkMemberLikes;
use app\admin\model\WkSubject;

class WkLogic{


    /**
     * 获取该用户信息
     * @return array
     */
    public function getUser(){
        return [
            "username" => 'aa',
        ];
    }

    /**
     * 课程列表
     * @param $input
     * @param int $pageIndex
     * @param int $eachPage
     * @return array
     */
    public function subject_list($input, $pageIndex=1, $eachPage=100){
        $default = [
            'data' => [],
            'total' => 0,
        ];
        $pageOffset = ($pageIndex-1)*$eachPage;

        $list = (new WkSubject())->order("sort", 'desc')->order("click_count","desc")
            ->limit($pageOffset,$eachPage)->select();
        $list = collection($list)->toArray();

        foreach ($list as $k => $item){
            $list[$k]['img'] = request()->domain().$item['icon_image'];
        }

        $default['data'] = $list;
        $default['total'] = (new WkSubject())->count();
        return $default;
    }


    /**
     * 试卷列表
     * @param $input
     * @param int $pageIndex
     * @param int $eachPage
     * @return array
     */
    public function exam_list($input, $pageIndex=1, $eachPage=100){
        $default = [
            'data' => [],
            'total' => 0,
        ];
        $pageOffset = ($pageIndex-1)*$eachPage;

        if(!empty($input['subject_id'])){
            $whereFunc = function () use($input){
                $obj = new WkExam();
                $obj = $obj->where('subject_id',$input['subject_id'])->order("sort", 'desc');
                return $obj;
            };
            $list = $whereFunc()->order("sort", 'desc')->limit($pageOffset,$eachPage)->select();
            $list = collection($list)->toArray();
            $default['data'] = $list;
            $default['total'] = $whereFunc()->count();
            return $default;
        }

        if(!empty($input['tag'])){
            switch ($input['tag']){
                case "like":
                    $whereFunc = function () use($input){
                        $likes = (new WkMemberLikes())->with(["wkexam"]) ->where("wkmemberlikes.question_id",null)
                            ->where('wkmemberlikes.username',$this->getUser());
                        return $likes;
                    };
                    $list = $whereFunc()->order("wkmemberlikes.createtime","desc")->limit($pageOffset,$eachPage)->select();
                    $list = collection($list)->toArray();
                    $default['data'] = $list;
                    $default['total'] = $whereFunc()->count();
                    break;
                default :   //history
                    $whereFunc = function () use($input){
                        $histories = (new WkMemberHistory())->with(["wkexam"])->where('wkmemberhistory.username',$this->getUser())
                            ->where("wkmemberlikes.question_id",null);
                        return $histories;
                    };
                    $list = $whereFunc()->order("wkmemberhistory.createtime","desc")->limit($pageOffset,$eachPage)->select();
                    $list = collection($list)->toArray();
                    $default['data'] = $list;
                    $default['total'] = $whereFunc()->count();
                    break;
            }
        }

        return $default;
    }

    //试卷信息
    public function exam_info($input){
        $exam_id = $input['id'] ?? 0;
        $obj = new WkExam();
        $row = $obj->where('id',$exam_id)->find();
        $row->batch_number = time();
        return $row;
    }

    /**
     * 每一个问题的信息
     * @param $input
     * @return array
     */
    public function each_question($input){
        $default = [
            'status' => 0,   //0表示为空 1表示有
            'flag' => 0,    // 1表示这个第一条 2表示这是最后一条 3表示既是第一条 也是最后一条
            'data' => [],
        ];

        $obj = new WkExamQuestion();
        if(!empty($input['exam_id'])){
            $obj =$obj->where('exam_id',$input['exam_id']);
        }
        if(!empty($input['id'])){
            $obj =$obj->where('id',$input['id']);
        }
        if(!empty($input['question_index'])){
            $obj = $obj->where('question_index',$input['question_index']);
        }
        $row = $obj->find();
        if(empty($row)){
            return $default;
        }else{
            $default['status'] = 1;
        }
        $row->answer_choice = (new WkAnswerChoice)->where('id',$row->id)->select();

        $max_question_index = (new WkExamQuestion())->where('exam_id',$row->exam_id)->max("question_index");
        $min_question_index = (new WkExamQuestion())->where('exam_id',$row->exam_id)->min("question_index");

        $row->next_index = $max_question_index==$row->question_index?$max_question_index:
            (new WkExamQuestion())->where('exam_id',$row->exam_id)
                ->where('question_index','>',$row->question_index)->min('question_index');

        $row->prev_index = $min_question_index==$row->question_index?$min_question_index:
            (new WkExamQuestion())->where('exam_id',$row->exam_id)
                ->where('question_index','<',$row->question_index)->max('question_index');

        if($max_question_index == $row->question_index){
            $default['flag'] = 2;
        }
        if($min_question_index == $row->question_index){
            $default['flag'] = 1;
        }
        if($max_question_index == $row->question_index && $min_question_index == $row->question_index){
            $default['flag'] = 3;
        }

        $default['data'] = $row;

        return $default;
    }


    /**
     * 处理回答
     * @param $input
     */
    public function do_answer($input){
        $row = (new WkExamQuestion())->where('id',$input['question_id'])->find();
        $insert_data = [
            'batch_number' => $input['batch_number'] ?? time(),
            'exam_id' => $input['exam_id'] ?? 0,
            'question_id' => $input['question_id'] ?? 0,
            'question_name' => $row['name_detail'],
            'answer' =>  $input['answer'] ?? '',
            'score' =>  $row->answer == $input['answer'] ? $row->score : 0,
            "createtime" => time(),
            'username' => $this->getUser(),
        ];
        $res = (new WkMemberAnswers )->insert($insert_data);
        return true;
    }

    /**
     * 总分
     */
    public function total_score($input){
        $batch_number = $input['batch_number'] ?? '';
        $username =  $this->getUser();
        $score = (new WkMemberAnswers )->where('username',$username)
            ->where('batch_number',$batch_number)->sum('score');
        return [
            'score' => $score,
        ];
    }

    /**
     * 处理收藏
     * @param $input
     */
    public function do_like($input){
        $flag = $input['flag'] ?? 1;   //1收藏 0取消
        $type = $input['type'] ?? 'subject';   //subject exam question
        $insert_data = [
            'username' => $this->getUser(),
            'question_id' => $input['question_id'] ?? null,
            'exam_id' => $input['exam_id'] ?? null,
            'subject_id' => $input['subject_id'] ?? null,
            'createtime' => time(),
        ];
        if($flag){
            $res = (new WkMemberLikes())->insert($insert_data);
            return true;
        }else{
            switch($type){
                case 'subject':
                    (new WkMemberLikes())->where('subject_id',$input['subject_id'])
                        ->where('exam_id',null)->where('question_id',null)->delete();
                    return true;
                case 'exam':
                    (new WkMemberLikes())->where('exam_id',$input['subject_id'])->where('question_id',null)->delete();
                    return true;
                case 'question':
                    (new WkMemberLikes())->where('question_id',$input['question_id'])->delete();
                    return true;
            }
        }
        return true;
    }

    /**
     * 处理浏览历史
     * @param $input
     */
    public function do_history($input){
        $insert_data = [
            'username' => $this->getUser(),
            'question_id' => $input['question_id'] ?? null,
            'exam_id' => $input['exam_id'] ?? null,
            'subject_id' => $input['subject_id'] ?? null,
            'createtime' => time(),
        ];
        $res = (new WkMemberLikes())->insert($insert_data);
        return true;
    }


}