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

    public function getHomeRecommendById($id)
    {
        return HomeRecommendModel::where('id', $id)->first();
    }
    public function addClickNumber($id)
    {
        return HomeRecommendModel::where('id', $id)->increment('click_num');
    }

    public function addFavorite($id)
    {
        return HomeRecommendModel::where('id', $id)->increment('favorite_num');
    }
    public function delFavorite($id)
    {
        return HomeRecommendModel::where('id', $id)->decrement('favorite_num');
    }
}