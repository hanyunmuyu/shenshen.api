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
        for ($i = 0; $i < 5; $i++) {
            foreach ($activityList as $list) {
                $club = $this->getUserByClubId($list->club_id);
                $data = [];
                $data['club_id'] = $list->club_id;
                $data['activity_id'] = $list->id;
                $data['user_id'] = $club->user_id;
                $data['content'] = '哈哈哈哈哈哈' . microtime(true);
                $data['status'] = random_int(0, 3);
                $data['add_time'] = time();
                $this->addClubActivityPost($data);
            }
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

    private function getUserByClubId($clubId)
    {
        return \App\Models\ClubUserModel::where('club_id', $clubId)
            ->orderBy(\Illuminate\Support\Facades\DB::raw('RAND()'))->first();
    }
}
