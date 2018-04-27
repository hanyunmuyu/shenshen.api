<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27 0027
 * Time: 下午 12:32
 */

namespace App\Repositories\v1;


use App\Models\UserCollectionModel;

class UserCollectionRepository
{
    public function addCollection($sourceId, $tag, $uid)
    {
        return UserCollectionModel::insert([
            'user_id' => $uid,
            'source_id' => $sourceId,
            'tag' => $tag,
            'add_time' => time()
        ]);
    }

    public function delCollection($sourceId, $tag, $uid)
    {
        return UserCollectionModel::where('user_id', $uid)
            ->where('source_id', $sourceId)
            ->where('tag', $tag)
            ->delete();
    }

    public function getCollection($uid, $tag, $sourceId)
    {
        return UserCollectionModel::where('user_id', $uid)
            ->where('source_id', $sourceId)
            ->where('tag', $tag)
            ->first();
    }

}