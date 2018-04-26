<?php

use Illuminate\Database\Seeder;

class SchoolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 0; $i < 1000; $i++){
            \Illuminate\Support\Facades\DB::table('school')->insert([
                'name'=>'河南工业大学-'.$i.'_'.time(),
                'logo'=>'/upload/gd.jpg',
                'description' => '河南工业大学（Henan University of Technology）位于河南省省会郑州，由河南省人民政府和国家粮食局共建，入选中西部高校基础能力建设工程、卓越工程师教育培养计划、卓越农林人才教育培养计划、2011计划。学校前身是中央粮食干部学校，是...',
                'add_time'=>time(),
                'status'=>3
            ]);
        }
    }
}
