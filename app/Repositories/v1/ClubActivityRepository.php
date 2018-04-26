<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/26 0026
 * Time: 下午 15:23
 */

namespace App\Repositories\v1;


use App\Models\ClubActivityModel;

class ClubActivityRepository
{
    public function getClubNewActivity($clubId)
    {
        return ClubActivityModel::where('club_id', $clubId)->orderBy('id', 'desc')->paginate(16);
    }
}