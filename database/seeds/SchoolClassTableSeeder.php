<?php

use Illuminate\Database\Seeder;

class SchoolClassTableSeeder extends Seeder
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
            \Illuminate\Support\Facades\DB::table('school_class')->insert([
                'school_id' => $i + 1,
                'school_department_id' => $i + 1,
                'name' => '经贸八班-' . $i,
                'add_time' => time(),
                'status' => $i % 3
            ]);
        }
    }
}
