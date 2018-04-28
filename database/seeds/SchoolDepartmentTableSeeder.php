<?php

use Illuminate\Database\Seeder;


class SchoolDepartmentTableSeeder extends Seeder
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
        for ($i = 0; $i < 20; $i++) {
            foreach ($schoolList as $key => $value) {
                $data = [
                    'school_id' => $value->id,
                    'name' => '经济贸易学院-' . $i . '-' . microtime(true),
                    'logo' => $this->getImg(),
                    'description' => '经济贸易学院',
                    'add_time' => time(),
                    'status' => $key % 4
                ];
                $this->addDepartment($data);
            }

        }
    }

    private function getSchoolList()
    {
        return \App\Models\SchoolModel::where('status', 3)->orderBy(\Illuminate\Support\Facades\DB::raw('RAND()'))->get();
    }

    public function addDepartment($data)
    {
        \App\Models\SchoolDepartmentModel::insert($data);
    }
}
