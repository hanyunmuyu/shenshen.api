<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        $this->call(SchoolTableSeeder::class);
        $this->call(SchoolDepartmentTableSeeder::class);
        $this->call(ClubTableSeeder::class);
        $this->call(HomeRecommendTableSeeder::class);
//        $this->call(SchoolClassTableSeeder::class);
//        $this->call(ClubActivityTableSeeder::class);
//        $this->call(UserSeeder::class);
//        $this->call(ClubActivityPostTableSeeder::class);
    }
}
