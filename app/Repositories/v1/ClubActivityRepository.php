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

    public function getClubActivityByIds($idList)
    {
        return ClubActivityModel::leftjoin('club','club.id','=','club_activity.club_id')
            ->select('club_activity.*','club.name','club.logo')
            ->whereIn('club_activity.id', $idList)->get();
    }

    public function getClubActivityByActivityId($id)
    {
        return ClubActivityModel::where('id', $id)->first();
    }
}