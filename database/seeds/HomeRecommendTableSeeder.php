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
        //TODO
        //后期要加上校园活动，学院活动
        //目前只是推送了社团活动的数据
        $clubActivityList = $this->getClubActivityList();
        foreach ($clubActivityList as $list) {
            $tmp = [];
            $index = random_int(1, 1000);
            $tmp = [
                'source_id' => $list->id,
                'tag'=>'club',
                'title' => '好美的春色-' . microtime(true),
                'description' => '冬色爷爷送走了大地的严寒，春姑娘踏着轻盈的脚步来到了人间，春色作文[智库|专题]。春天的景色十分美丽，就像一幅栩栩如生的画。',
                'add_time' => time(),
                'click_num' => $list->click_num,
                'favorite_num' => $list->favorite_num,
            ];
            if ($index % 4 === 0) {
                $tmp['img_a'] = $this->getImg();
                $tmp['img_b'] = $this->getImg();
                $tmp['img_c'] = $this->getImg();
            } elseif ($index % 4 === 1) {
                $tmp['img_a'] = $this->getImg();
                $tmp['img_b'] = $this->getImg();
            } elseif ($index % 4 === 2) {
                $tmp['img_a'] = $this->getImg();
            }
            \Illuminate\Support\Facades\DB::table('home_recommend')->insert($tmp);
        }
    }

    private function getClubActivityList()
    {
        return \App\Models\ClubActivityModel::orderBy(\Illuminate\Support\Facades\DB::raw('RAND()'))
            ->limit(10000)
            ->get();
    }
}
