<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28 0028
 * Time: 下午 17:23
 */

namespace App\Repositories\v1;


use App\Models\ClubActivityPostModel;

class ClubActivityPostRepository
{
    public function getClubActivityPostListByClubActivityId($clubActivityId)
    {
        return ClubActivityPostModel::where('activity_id', $clubActivityId)
            ->orderBy('id', 'desc')
            ->paginate(16);
    }
}