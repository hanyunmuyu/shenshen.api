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
    public function addCollection($id,$tag, $uid)
    {
        return UserCollectionModel::insert([
            'user_id' => $uid,
            'source_id' => $id,
            'tag' => $tag,
            'add_time' => time()
        ]);
    }

    public function getCollection($uid, $sourceId)
    {
        return UserCollectionModel::where('user_id', $uid)
            ->where('source_id', $sourceId)
            ->first();
    }

    public function delCollection($uid, $sourceId)
    {
        return UserCollectionModel::where('user_id', $uid)
            ->where('source_id', $sourceId)
            ->delete();
    }
}