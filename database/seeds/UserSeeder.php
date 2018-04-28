<?php

use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
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
        $schoolClassList = $this->getSchoolClassList();
        for ($i = 0; $i < 35; $i++) {
            foreach ($schoolClassList as $key => $list) {
                \Illuminate\Support\Facades\DB::table('user')->insert([
                    'school_id' => $list->school_id,
                    'school_department_id' => $list->school_department_id,
                    'school_class_id' => $list->id,
                    'user_name' => 'hanyun-' . microtime(true),
                    'user_pwd' => md5('123456'),
                    'avatar' => $this->getImg(),
                    'gender' => $i % 3,
                    'add_time' => time(),
                    'status' => $key % 4,

                ]);
            }
        }
    }

    private function getSchoolClassList()
    {
        return \App\Models\SchoolClassModel::where('status', 3)->orderBy(\Illuminate\Support\Facades\DB::raw('RAND()'))->get();
    }
}
