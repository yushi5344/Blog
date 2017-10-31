<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    //
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
}
