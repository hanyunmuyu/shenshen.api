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

    public function getHomeRecommendByTagAndSourceId($sourceId, $tag)
    {
        return HomeRecommendModel::where('source_id', $sourceId)
            ->where('tag', $tag)
            ->first();
    }

    public function addClickNumber($sourceId, $tag)
    {
        return HomeRecommendModel::where('source_id', $sourceId)
            ->where('tag', $tag)
            ->increment('click_num');
    }

    public function addFavorite($sourceId, $tag)
    {
        return HomeRecommendModel::where('source_id', $sourceId)
            ->where('tag', $tag)
            ->increment('favorite_num');
    }

    public function delFavorite($sourceId, $tag)
    {
        return HomeRecommendModel::where('source_id', $sourceId)
            ->where('tag', $tag)
            ->decrement('favorite_num');
    }
}