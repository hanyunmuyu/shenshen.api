<?php

use Illuminate\Database\Seeder;
require_once __DIR__.'/Tools.php';

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
        foreach ($schoolList as $value) {
            for ($i=0; $i < 10; $i++) {
                $data = [
                    'school_id' => $value->id,
                    'name' => '经济贸易学院-' . $i . '-' . microtime(true),
                    'logo' => $this->getImg(),
                    'description' => '经济贸易学院',
                    'add_time' => time(),
                    'status' => $i % 4
                ];
                $this->addDepartment($data);
            }

        }
    }

    private function getSchoolList()
    {
        return \App\Models\SchoolModel::where('status',3)->orderBy(\Illuminate\Support\Facades\DB::raw('RAND()'))->get();
    }

    public function addDepartment($data)
    {
        \App\Models\SchoolDepartmentModel::insert($data);
    }
}
