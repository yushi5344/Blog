<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data=[
            [
                'link_name'=>'百度',
                'link_title'=>'全球最大的中文搜索引擎',
                'link_url'=>'https://www.baidu.com',
                'link_order'=>1
            ],
            [
                'link_name'=>'google',
                'link_title'=>'全球最大的搜索引擎',
                'link_url'=>'https://www.google.com',
                'link_order'=>2
            ]
        ];
        DB::table('links')->insert($data);
    }
}
