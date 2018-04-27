<?php

use Illuminate\Database\Seeder;
require_once __DIR__.'/Tools.php';

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
        for ($i = 0; $i < 500; $i++) {
            \Illuminate\Support\Facades\DB::table('home_recommend')->insert([
                'source_id'=>$i+1,
                'tag'=>$tag[$i%3],
                'title'=>'好美的春色',
                'description'=>'冬色爷爷送走了大地的严寒，春姑娘踏着轻盈的脚步来到了人间，春色作文[智库|专题]。春天的景色十分美丽，就像一幅栩栩如生的画。',
                'img_a'=>$this->getImg(),
                'img_b'=>$this->getImg(),
                'img_c'=>$this->getImg(),
                'add_time'=>time(),
                'click_num'=>$i*10,
                'favorite_num'=>$i*2
            ]);
        }
    }
}
