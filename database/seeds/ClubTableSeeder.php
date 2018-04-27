<?php

use Illuminate\Database\Seeder;
require_once __DIR__.'/Tools.php';

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
        $schoolList = $this->getSchoolList();
        foreach ($schoolList as $value) {
            for ($i=0; $i < 10; $i++) {
                $data = [
                    'name' => '轮滑社团-' . $i . '-' . microtime(true),
                    'create_user_id' => $i + 1,
                    'school_id' => $i + 1,
                    'logo' => $this->getImg(),
                    'description' => '我是社团，欢迎大家的家如',
                    'add_time' => time(),
                    'status' => $i % 4
                ];
                $this->addClub($data);
            }

        }
    }
    private function getSchoolList()
    {
        return \App\Models\SchoolModel::where('status',3)->orderBy(\Illuminate\Support\Facades\DB::raw('RAND()'))->get();
    }

    private function addClub($data)
    {
        \App\Models\ClubModel::insert($data);
    }
}
