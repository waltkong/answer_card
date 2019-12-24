<?php
namespace app\api\logic;

use PFinal\Excel\Excel;

class ExcelLogic{

    //$file './1.xlsx'
    // $headerMap  ['id' => '编号', 'name' => '姓名', 'date' => '日期']
    public function import($file,$headerMap){
        date_default_timezone_set('PRC');

        $data = Excel::readExcelFile($file, $headerMap);
        return $data;
    }

    public function export($data,$map,$file,$workSheetName='试卷信息'){
//        $data = [
//            ['id' => 1, 'name' => 'Jack', 'age' => 18, 'date'=>'2017-07-18'],
//            ['id' => 2, 'name' => 'Mary', 'age' => 20, 'date'=>'2017-07-18'],
//            ['id' => 3, 'name' => 'Ethan', 'age' => 34, 'date'=>'2017-07-18'],
//        ];
//
//        $map = [
//            'title'=>[
//                'id' => '编号',
//                'name' => '姓名',
//                'age' => '年龄',
//            ],
//        ];
//
//        $file = 'user' . date('Y-m-d');

        //浏览器直接下载
        Excel::exportExcel($data, $map, $file, $workSheetName);
    }

}