<?php
namespace app\api\library;

class HelperLibrary
{
    public static function getTodayBeginAndEndTime(){
        $t = time();
        $start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
        $end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
        return [
            'start' => date('Y-m-d H:i:s',$start),
            'end' => date('Y-m-d H:i:s',$end),
        ];
    }


    /** Json数据格式化,美化
     * @param  Mixed  $data   数据
     * @param  String $indent 缩进字符，默认4个空格
     * @return JSON
     */
    public static function jsonPretty($data, $indent=null){
        if(is_array($data)){
            $data = json_encode($data);
        }
        // 将urlencode的内容进行urldecode
        $data = urldecode($data);
        // 缩进处理
        $ret = '';
        $pos = 0;
        $length = strlen($data);
        $indent = isset($indent)? $indent : '    ';
        $newline = "\n";
        $prevchar = '';
        $outofquotes = true;

        for($i=0; $i<=$length; $i++){

            $char = substr($data, $i, 1);

            if($char=='"' && $prevchar!='\\'){
                $outofquotes = !$outofquotes;
            }elseif(($char=='}' || $char==']') && $outofquotes){
                $ret .= $newline;
                $pos --;
                for($j=0; $j<$pos; $j++){
                    $ret .= $indent;
                }
            }

            $ret .= $char;

            if(($char==',' || $char=='{' || $char=='[') && $outofquotes){
                $ret .= $newline;
                if($char=='{' || $char=='['){
                    $pos ++;
                }

                for($j=0; $j<$pos; $j++){
                    $ret .= $indent;
                }
            }

            $prevchar = $char;
        }
        return $ret;
    }


    public static function UTC2dateTime($str){
        $str =  str_replace("T"," ",$str);
        $str =  str_replace("Z","",$str);
        return trim($str);
    }

    public static function timestamp2UTC($str){
        $date1 = date('Y-m-d',$str);
        $date2 = date('H:i:s',$str);
        return $date1.'T'.$date2.'Z';
    }


}
