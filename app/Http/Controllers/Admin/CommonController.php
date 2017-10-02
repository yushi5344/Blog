<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    //

    public function upload(Request $request)
    {
        // Make sure file is not cached (as it happens for example on iOS devices)
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        $file=Input::file('file');
        if($file->isValid()){
            $realPth=$file->getRealPath();
            $entension=$file->getClientOriginalExtension();
            $newName=date('Ymd').time().mt_rand(100,999).'.'.$entension;
            $path=$file->move(base_path().'/upload',$newName);
            $filePath='upload/'.$newName;
            return $filePath;
        }
    }

}
