<?php

use Illuminate\Database\Seeder;


class ClubTableSeeder extends Seeder
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
        for ($i = 0; $i < 1; $i++) {
            foreach ($userList as $key => $value) {
                $data = [
                    'name' => '轮滑社团-' . $i . '-' . microtime(true),
                    'create_user_id' => $value->id,
                    'school_id' => $value->school_id,
                    'logo' => $this->getImg(),
                    'description' => '我是社团，欢迎大家的家如',
                    'add_time' => time(),
                    'status' => $key % 4
                ];
                $this->addClub($data);
            }

        }
    }

    private function getUserList()
    {
        return \App\User::where('status', 3)->orderBy(\Illuminate\Support\Facades\DB::raw('RAND()'))->get();
    }

    private function addClub($data)
    {
        \App\Models\ClubModel::insert($data);
    }
}
