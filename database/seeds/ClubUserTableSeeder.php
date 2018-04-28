<?php

use Illuminate\Database\Seeder;

class ClubUserTableSeeder extends Seeder
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
        $userList = $this->getUserList();
        for ($i = 0; $i < 5; $i++) {
            foreach ($userList as $list) {
                $club = $this->getClubBySchoolId($list->school_id);
                $data = [];
                $data['school_id'] = $list->school_id;
                $data['club_id'] = $club->id;
                $data['user_id'] = $list->id;
                $data['type'] = random_int(0, 1);
                $data['add_time'] = time();
                \App\Models\ClubUserModel::insert($data);
            }
        }
    }

    private function getClubBySchoolId($schoolId)
    {
        return \App\Models\ClubModel::where('status', 3)
            ->where('school_id', $schoolId)
            ->orderBy(\Illuminate\Support\Facades\DB::raw('RAND()'))->first();
    }
}
