<?php

namespace App\Http\Controllers\Excel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Wechat_user as User;
use Excel;
class ExcelController extends Controller
{
    //导出
    public function export(){

        $user=User::All();
        $data=[];
        foreach($user as $v){
            $a=$v->toArray($v);
            $data[]=array_values($a);
            $key=array_keys($a);
        }
        $keys[]=$key;
        $data=array_merge($keys,$data);
        Excel::create('人物',function($excel) use($data){
            $excel->sheet('score',function($sheet)use ($data){
                $sheet->rows($data);
            });
        })->export('xls');

    }
}
