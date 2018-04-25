<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2018/4/25
 * Time: 20:12
 */

namespace App\Repositories\v1;


use App\Models\HomeRecommendModel;

class HomeRecommendRepository
{
    public function getHomeRecommendList()
    {
        return HomeRecommendModel::orderBy('id', 'desc')->paginate(16);
    }
}