<?php

use Illuminate\Database\Seeder;

class ClubActivityPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $activityList = $this->getClubActivityList();
        foreach ($activityList as $list) {
            $data = [];
            $data['club_id'] = $list->club_id;
            $data['activity_id'] = $list->id;
            $data['user_id'] = $list->user_id;
            $data['content'] = '哈哈哈哈哈哈';
            $data['status'] = random_int(0, 3);
            $data['add_time'] = time();
            $this->addClubActivityPost($data);
        }
    }

    private function getClubActivityList()
    {
        return \App\Models\ClubActivityModel::all();
    }

    private function addClubActivityPost($data)
    {
        \Illuminate\Support\Facades\DB::table('club_activity_post')->insert($data);
    }
}
