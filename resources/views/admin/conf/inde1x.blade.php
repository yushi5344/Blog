@extends('layouts.admin')

@section('content')
    <section class="Hui-article-box">
        <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span class="c-gray en">&gt;</span> 基本设置 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
        <div class="Hui-article">
            <article class="cl pd-20">
                <div id="tab-system" class="HuiTab">
                    <div class="tabBar cl"><span>基本设置</span><span>安全设置</span><span>邮件设置</span><span>其他设置</span></div>
                    <div class="tabCon">
                        <form action="" method="post" class="form form-horizontal" id="form-conf-basic">
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>配置名称：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="website-title" placeholder="控制在25个字、50个字节以内" value="" class="input-text" name="conf_name">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>标题：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="website-Keywords" placeholder="" value="" class="input-text" name="conf_title">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>类型：</label>
                                <div class="formControls col-xs-8 col-sm-9 skin-minimal show_type">
                                    <div class="radio-box">
                                        <input name="field_type" value="1" type="radio" id="field_type-1" checked>
                                        <label for="field_type-1">input</label>
                                    </div>
                                    <div class="radio-box">
                                        <input type="radio" value="2" id="field_type-2" name="field_type">
                                        <label for="field_type-2">textarea</label>
                                    </div>
                                    <div class="radio-box">
                                        <input type="radio" value="3" id="field_type-3" name="field_type">
                                        <label for="field_type-3">radio</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row cl type_show" style="display: none">
                                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>类型值：</label>
                                <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                                    <div class="radio-box">
                                        <input name="field_value" value="1" type="radio" id="field_value-1" checked>
                                        <label for="field_value-1">开启</label>
                                    </div>
                                    <div class="radio-box">
                                        <input type="radio" value="0" id="field_value-2" name="field_value">
                                        <label for="field_value-2">关闭</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>排序：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="website-uploadfile" placeholder="" value="" class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">说明：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <textarea class="textarea"></textarea>
                                </div>
                            </div>
                            <div class="row cl">
                                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                                    <button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
                                    <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tabCon">
                        <form action="" method="post" class="form form-horizontal" id="form-conf-safe">
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">允许访问后台的IP列表：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <textarea class="textarea"></textarea>
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">后台登录失败最大次数：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="" value="5" class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                                    <button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
                                    <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tabCon">
                        <form action="" method="post" class="form form-horizontal" id="form-conf-email">
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">邮件发送模式：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="" value="" class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">SMTP服务器：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="" value="" class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">SMTP 端口：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="" value="25" class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">邮箱帐号：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="email-name" value="" class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">邮箱密码：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="password" id="email-password" value="" class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">收件邮箱地址：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="email-address" value="" class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                                    <button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
                                    <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tabCon"> </div>
                </div>
            </article>
        </div>
    </section>
@endsection


@section('javascriptfooter')
    <script type="text/javascript" src="{{asset('resources/views/admin/lib/jquery.validation/1.14.0/jquery.validate.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/admin/lib/jquery.validation/1.14.0/validate-methods.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/admin/lib/jquery.validation/1.14.0/messages_zh.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            $('.show_type input').on('ifChecked', function(event){ //ifCreated 事件应该在插件初始化之前绑定
                if($(this).val()==3){
                    $('.type_show').show();
                }else{
                    $('.type_show').hide();
                }

            });
            $('.skin-minimal input').iCheck({
                checkboxClass: 'icheckbox-blue',
                radioClass: 'iradio-blue',
                increaseArea: '20%'
            });
            $('#tab-system').Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
        });
    </script>
@endsection