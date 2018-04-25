<?php

use Illuminate\Database\Seeder;

class SchoolDepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i < 100; $i++) {
            \Illuminate\Support\Facades\DB::table('school_department')->insert([
                'school_id'=>$i,
                'name' => '经济贸易学院-' . $i .'-'. time(),
                'logo'=>'',
                'description'=>'经济贸易学院',
                'add_time'=>time(),
                'status'=>$i%3
            ]);
        }
    }
}
