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

    public function sendMailWithAttachment(){
        $name='李四';
        $flag = Mail::send('email.send',['name'=>$name],function($message){
            $to = '424239968@qq.com';
            $message->to($to)->subject('周末聚一发');

            $attachment = storage_path('logs/laravel.log');
            //在邮件中上传附件
            $message->attach($attachment,['as'=>"=?UTF-8?B?".base64_encode('测试文档')."?=.log"]);
        });
        if($flag){
            echo '发送邮件成功，请查收！';
        }else{
            echo '发送邮件失败，请重试！';
        }
    }
}
