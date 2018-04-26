<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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
            \Illuminate\Support\Facades\DB::table('user')->insert([
                'school_id' => $i + 1,
                'school_department_id' => $i + 1,
                'school_class_id' => $i + 1,
                'user_name' => 'hanyun-' . $i,
                'user_pwd' => md5('123456'),
                'avatar' => '/static/images/avatar5.jpg',
                'gender' => $i % 3,
                'add_time'=>time(),
                'status' => $i % 4,

            ]);
        }
    }
}
