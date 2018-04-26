<?php

use Illuminate\Database\Seeder;

class UserPostTableSeeder extends Seeder
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
            \Illuminate\Support\Facades\DB::table('user_post')->insert([
                'user_id' => $i + 1,
                'school_id' => $i + 2,
                'title' => '人至贱则无敌',
                'content' => '真贱真贱真贱真贱真贱真贱真贱',
                'status' => $i % 4,
                'add_time' => time(),
            ]);
        }
    }
}
