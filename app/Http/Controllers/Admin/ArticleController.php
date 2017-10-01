<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

class ArticleController extends CommonController{

    public function show(){
        return view('admin.article_list');
    }
}
