<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2018/4/24
 * Time: 20:00
 */

namespace App\Repositories\v1;


use App\Models\ClubModel;

class ClubRepository
{
    public function getClubList()
    {
        return ClubModel::where('status', 3)->orderBy('id', 'desc')->paginate(16);
    }

    public function getClubById($clubId)
    {
        return ClubModel::where('id', $clubId)->first();
    }
}