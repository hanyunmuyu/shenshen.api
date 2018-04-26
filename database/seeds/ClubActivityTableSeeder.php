<?php

use Illuminate\Database\Seeder;

class ClubActivityTableSeeder extends Seeder
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
            \Illuminate\Support\Facades\DB::table('club_activity')->insert([
                'club_id' => $i + 1,
                'school_id'=>$i+1,
                'title'=>'画好越远',
                'content' => '人间美景人间美景人间美景',
                'user_id' => $i + 1
            ]);
        }
    }
}
