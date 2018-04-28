<?php

use Illuminate\Database\Seeder;

class HomeRecommendTableSeeder extends Seeder
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
        $tag = ['club', 'user_post', 'school'];
        $data = [];
        $clubList = $this->getClubList();
        $schooLList = $this->getSchoolList();
        foreach ($clubList as $club) {
            $tmp = [];
            $tmp['tag'] = 'club';
            $tmp['source_id'] = $club->id;
            $data[] = $tmp;
        }
        foreach ($schooLList as $school) {
            $tmp = [];
            $tmp['tag'] = 'school';
            $tmp['source_id'] = $school->id;
            $data[] = $tmp;
        }
        for ($i = 0; $i < 10000; $i++) {
            $index = array_rand($data);
            $tmp = [
                'title' => '好美的春色-'.microtime(true),
                'description' => '冬色爷爷送走了大地的严寒，春姑娘踏着轻盈的脚步来到了人间，春色作文[智库|专题]。春天的景色十分美丽，就像一幅栩栩如生的画。',
                'add_time' => time(),
                'click_num' => $i * 10,
                'favorite_num' => $i * 2
            ];
            if ($index%4===0) {
                $tmp['img_a'] = $this->getImg();
                $tmp['img_b'] = $this->getImg();
                $tmp['img_c'] = $this->getImg();
            } elseif ($index%4===1) {
                $tmp['img_a'] = $this->getImg();
                $tmp['img_b'] = $this->getImg();
            } elseif ($index%4===2) {
                $tmp['img_a'] = $this->getImg();
            }
            \Illuminate\Support\Facades\DB::table('home_recommend')->insert(array_merge($tmp,$data[$index]));
        }
    }

    private function getClubList()
    {
        return \App\Models\ClubModel::where('status', 3)->orderBy(\Illuminate\Support\Facades\DB::raw('RAND()'))->get();
    }

    private function getSchoolList()
    {
        return \App\Models\SchoolModel::where('status',3)->orderBy(\Illuminate\Support\Facades\DB::raw('RAND()'))->get();
    }
}
