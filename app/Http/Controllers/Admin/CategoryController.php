<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
    /**
     * @Desc:分类列表显示
     * @author:guomin
     * @date:2017-10-01 16:16
     * @return $this
     */
    public function index()
    {
        //
        $category=new Category();
        $data=$category->getTree();
        return view('admin.category.index')->with('data',$data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cate=DB::table('blog_category')->where('cate_pid','=',0)->get();
        return view('admin.category.add')->with('cate',$cate);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input=Input::except('_token');
        $rules=[
            'cate_name'=>'required|between:4,16',
            'cate_order'=>'required|integer',
            'cate_title'=>'required'
        ];
        $messages=[
            'cate_name.required'=>'分类名称不能为空',
            'cate_name.between'=>'分类名称在4到16位之间',
            'cate_order.required'=>'排序不能为空',
            'cate_order.integer'=>'排序必须为整数',
            'cate_title.required'=>'分类标题不能为空',
        ];
        $validator=Validator::make($input,$rules,$messages);
        if($validator->passes()){
            $re=Category::create($input);
            if($re){
                $data=[
                    'status'=>1,
                    'msg'=>'分类新增成功'
                ];
            }else{
                $data=[
                    'status'=>0,
                    'msg'=>'分类新增失败'
                ];
            }
            return $data;
        }else{
            $errors=$validator->errors()->all();
            $error=implode(',',$errors);
            $data=[
                'status'=>0,
                'msg'=>$error
            ];
            return $data;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $data=Category::find($id);
        $cate=DB::table('blog_category')->where('cate_pid','=',0)->get();
        return view('admin.category.edit',compact('data','cate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input=Input::except('_token');
        $rules=[
            'cate_name'=>'required|between:4,16',
            'cate_order'=>'required|integer',
            'cate_title'=>'required'
        ];
        $messages=[
            'cate_name.required'=>'分类名称不能为空',
            'cate_name.between'=>'分类名称在4到16位之间',
            'cate_order.required'=>'排序不能为空',
            'cate_order.integer'=>'排序必须为整数',
            'cate_title.required'=>'分类标题不能为空',
        ];
        $validator=Validator::make($input,$rules,$messages);
        if($validator->passes()){
            $category=new Category();
            $re=$category->save($input);
            if($re){
                $data=[
                    'status'=>1,
                    'msg'=>'分类修改成功'
                ];
            }else{
                $data=[
                    'status'=>0,
                    'msg'=>'分类修改失败'
                ];
            }
            return $data;
        }else{
            $errors=$validator->errors()->all();
            $error=implode(',',$errors);
            $data=[
                'status'=>0,
                'msg'=>$error
            ];
            return $data;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cate_id)
    {
        //
        $re=Category::where('cate_id',$cate_id)->delete();
        Category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);
        if($re){
            $data=[
                'status'=>1,
                'msg'=>'删除成功'
            ];
        }else{
            $data=[
                'status'=>0,
                'msg'=>'删除失败'
            ];
        }
        return $data;
    }

    /**
     * @Desc:ajax无刷新修改排序
     * @author:guomin
     * @date:2017-10-01 15:31
     * @param $cate_id 分类id
     * @param $cate_order 排序字段
     */
    public function changeOrder($cate_id,$cate_order){
        $category=Category::find($cate_id);
        $category->cate_order=$cate_order;
        $res=$category->save();
        if($res){
            $data=[
                'status'=>1,
                'msg'=>'修改成功',
            ];
        }else{
            $data=[
                'status'=>0,
                'msg'=>'修改失败',
            ];
        }
        return $data;
    }
}
