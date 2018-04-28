<?php

use Illuminate\Database\Seeder;

class ClubActivityTableSeeder extends Seeder
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
        $dataList = $this->getUserList();
        for ($i = 0; $i < 10; $i++) {
            foreach ($dataList as $key => $list) {
                $club = $this->getClubBySchoolId($list->school_id);
                $tmp = [
                    'club_id' => $club->id,
                    'school_id' => $list->school_id,
                    'title' => '画好越远',
                    'content' => '人间美景人间美景人间美景',
                    'user_id' => $list->id,
                    'add_time' => time(),
                ];
                if ($key % 4 === 0) {
                    $tmp['img_a'] = $this->getImg();
                    $tmp['img_b'] = $this->getImg();
                    $tmp['img_c'] = $this->getImg();
                } elseif ($key % 4 === 1) {
                    $tmp['img_a'] = $this->getImg();
                    $tmp['img_b'] = $this->getImg();
                } elseif ($key % 4 === 2) {
                    $tmp['img_a'] = $this->getImg();
                }
                \Illuminate\Support\Facades\DB::table('club_activity')->insert($tmp);
            }
        }
    }

    private function getUserList()
    {
        return \App\User::where('status', 3)->orderBy(\Illuminate\Support\Facades\DB::raw('RAND()'))->limit(1000)->get();
    }

    private function getClubBySchoolId($schoolId)
    {
        return \App\Models\ClubModel::where('school_id', $schoolId)->where('status', 3)->orderBy(\Illuminate\Support\Facades\DB::raw('RAND()'))->first();
    }
}
