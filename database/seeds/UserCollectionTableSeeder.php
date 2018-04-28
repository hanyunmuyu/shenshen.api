<?php

use Illuminate\Database\Seeder;

class UserCollectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dataList = $this->getHomeRecommendList();
        $userList = $this->getUserList();
        foreach ($dataList as $list) {
            $userKey = array_rand($userList);
            $user = $userList[$userKey];
            $tmp = [];
            $tmp['user_id'] = $user['id'];
            $tmp['source_id'] = $list->source_id;
            $tmp['tag'] = $list->tag;
            $tmp['add_time'] = time();
            $this->addFavorite($tmp);
        }
    }

    private function addFavorite($data)
    {
        \Illuminate\Support\Facades\DB::table('user_collection')->insert($data);
        \App\Models\HomeRecommendModel::where('source_id', $data['source_id'])
            ->where('tag', $data['tag'])
            ->increment('favorite_num');

    }

    private function getHomeRecommendList()
    {
        return \App\Models\HomeRecommendModel::orderBy(\Illuminate\Support\Facades\DB::raw('RAND()'))->get();
    }

    private function getUserList()
    {
        return \App\User::where('status', 3)->orderBy(\Illuminate\Support\Facades\DB::raw('RAND()'))->get()->toArray();
    }
}
