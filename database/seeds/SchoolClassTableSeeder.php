<?php

use Illuminate\Database\Seeder;

class SchoolClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dataList = $this->getSchoolDepartmentList();
        for ($i = 0; $i < 10; $i++) {
            foreach ($dataList as $key => $list) {
                \Illuminate\Support\Facades\DB::table('school_class')->insert([
                    'school_id' => $list->school_id,
                    'school_department_id' => $list->id,
                    'name' => '经贸八班-' . microtime(true),
                    'add_time' => time(),
                    'status' => $key % 4
                ]);
            }

        }
    }

    private function getSchoolDepartmentList()
    {
        return \App\Models\SchoolDepartmentModel::where('status', 3)->orderBy(\Illuminate\Support\Facades\DB::raw('RAND()'))->get();
    }
}
