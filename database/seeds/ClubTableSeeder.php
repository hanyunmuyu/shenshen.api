<?php

use Illuminate\Database\Seeder;

class ClubTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 0; $i < 1000; $i++) {
            \Illuminate\Support\Facades\DB::table('club')->insert([
                'name' => '轮滑社团-' . $i . '-' . time(),
                'create_user_id'=>$i+1,
                'school_id'=>$i+1,
                'logo'=>'/upload/lunhua.jpg',
                'description'=>'我是社团，欢迎大家的家如',
                'add_time'=>time(),
                'status'=>$i%4
            ]);
        }
    }
}
