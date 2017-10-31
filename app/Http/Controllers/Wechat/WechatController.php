<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    //
    public function __construct()
    {
       // $this->responseMsg();
    }

    const TOKEN='guomin';

    public function index(){
        if(isset($_GET["signature"])&&isset($_GET["timestamp"])&&isset($_GET["nonce"])&&isset($_GET["echostr"])){
            $signature = $_GET["signature"];//从用户端获取签名赋予变量signature
            $timestamp = $_GET["timestamp"];//从用户端获取时间戳赋予变量timestamp
            $nonce = $_GET["nonce"];    //从用户端获取随机数赋予变量nonce

            $token = self::TOKEN;//将常量token赋予变量token
            $tmpArr = array($token, $timestamp, $nonce);//简历数组变量tmpArr
            sort($tmpArr, SORT_STRING);//新建排序
            $tmpStr = implode( $tmpArr );//字典排序
            $tmpStr = sha1( $tmpStr );//shal加密
            //tmpStr与signature值相同，返回真，否则返回假
            if( $tmpStr == $signature ){
                echo $_GET["echostr"];
            }else{
                return false;
            }
        }
    }

    public function store()
    {
        //get post data, May be due to the different environments
        $postStr = file_get_contents('php://input');//将用户端放松的数据保存到变量postStr中，由于微信端发送的都是xml，使用postStr无法解析，故使用$GLOBALS["HTTP_RAW_POST_DATA"]获取

        //extract post data如果用户端数据不为空，执行30-55否则56-58
        if (!empty($postStr)){

            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);//将postStr变量进行解析并赋予变量postObj。simplexml_load_string（）函数是php中一个解析XML的函数，SimpleXMLElement为新对象的类，LIBXML_NOCDATA表示将CDATA设置为文本节点，CDATA标签中的文本XML不进行解析
            $fromUsername = $postObj->FromUserName;//将微信用户端的用户名赋予变量FromUserName
            $toUsername = $postObj->ToUserName;//将你的微信公众账号ID赋予变量ToUserName
            $keyword = trim($postObj->Content);//将用户微信发来的文本内容去掉空格后赋予变量keyword
            $time = time();//将系统时间赋予变量time
            //构建XML格式的文本赋予变量textTpl，注意XML格式为微信内容固定格式，详见文档
            $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>";
            //39行，%s表示要转换成字符的数据类型，CDATA表示不转义
            //40行为微信来源方
            //41行为系统时间
            //42行为回复微信的信息类型
            //43行为回复微信的内容
            //44行为是否星标微信
            //XML格式文本结束符号
            if(!empty( $keyword ))//如果用户端微信发来的文本内容不为空，执行46--51否则52--53
            {
                $msgType = "text";//回复文本信息类型为text型，变量类型为msgType
                $contentStr = "Welcome to wechat world!";//我们进行文本输入的内容，变量名为contentStr，如果你要更改回复信息，就在这儿
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);//将XML格式中的变量分别赋值。注意sprintf函数
                echo $resultStr;//输出回复信息，即发送微信
            }else{
                echo "Input something...";//不发送到微信端，只是测试使用
            }

        }else {
            echo "aaa";//回复为空，无意义，调试用
            exit;
        }
    }
}
