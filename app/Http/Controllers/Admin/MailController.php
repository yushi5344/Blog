<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
class MailController extends Controller
{
    //
    public function index(){
        $name = '张三';
        $flag = Mail::send('email.send',['name'=>$name],function($message){
            $to = '424239968@qq.com';
            $message ->to($to)->subject('今天是星期五');
        });
        if($flag){
            echo '发送邮件成功，请查收！';
        }else{
            echo '发送邮件失败，请重试！';
        }
    }

    public function sendText(){
        Mail::raw('今天是星期一了，明天就星期二了。', function ($message) {
            $to = '424239968@qq.com';
            $message ->to($to)->subject('今天是星期一');
        });
    }
}
