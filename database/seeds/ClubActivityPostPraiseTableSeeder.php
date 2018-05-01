<?php

use Illuminate\Database\Seeder;

class ClubActivityPostPraiseTableSeeder extends Seeder
{
    use Tools;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $userList = $this->getUserList()->toArray();
        $postList = $this->getClubActivityPost();
        foreach ($postList as $list) {
            $key = array_rand($userList);
            $tmp = [];
            $tmp['activity_post_id'] = $list->id;
            $tmp['add_time'] = time();
            $tmp['activity_id'] = $list->activity_id;
            $tmp['user_id'] = $userList[$key]['id'];
            \Illuminate\Support\Facades\DB::table('club_activity_post_praise')->insert($tmp);
        }
    }

    private function getClubActivityPost()
    {
        return \App\Models\ClubActivityPostModel::orderBy(\Illuminate\Support\Facades\DB::raw('RAND()'))->limit(2000)->get();
    }
}
