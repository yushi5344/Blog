<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table='blog_articles';
    protected $primaryKey='art_id';
    public $timestamps=false;
    protected $guarded=[];
}
