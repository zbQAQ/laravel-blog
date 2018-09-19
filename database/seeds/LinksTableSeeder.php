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
    	//表数据插入
    	$data = [

	    	[
	            'link_name' => 'yangger.cn',
	            'link_title' => 'cynb',
	            'link_url' => 'yangger.cn',
	            'link_order' => 1,
	        ],
	        [
	            'link_name' => 'Laravel学院',
	            'link_title' => '致力于提供优质的laravel中文学习资源',
	            'link_url' => 'http://laravelacademy.org/',
	            'link_order' => '2',
	        ]

    	];

        DB::table('links')->insert($data);
    }
}
