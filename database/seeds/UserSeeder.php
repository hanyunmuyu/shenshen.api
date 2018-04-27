<?php

use Illuminate\Database\Seeder;
require_once __DIR__.'/Tools.php';

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
        $dataList = $this->getSchoolDepartment();
        foreach ($dataList as $list) {
            for ($i = 0; $i < 100; $i++) {
                \Illuminate\Support\Facades\DB::table('user')->insert([
                    'school_id' => $list->school_id,
                    'school_department_id' => $list->id,
                    'school_class_id' => $i + 1,
                    'user_name' => 'hanyun-' . $i.'-'.microtime(true),
                    'user_pwd' => md5('123456'),
                    'avatar' => $this->getImg(),
                    'gender' => $i % 3,
                    'add_time'=>time(),
                    'status' => $i % 4,

                ]);
            }
        }
    }

    private function getSchoolDepartment()
    {
        return \App\Models\SchoolDepartmentModel::where('status', 3)->orderBy(\Illuminate\Support\Facades\DB::raw('RAND()'))->get();
    }
}
