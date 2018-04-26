<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/26 0026
 * Time: 上午 8:55
 */

namespace App\Repositories\v1;


use App\Models\UserPostModel;

class UserPostRepository
{
    public function getUserPostByUserId($uid)
    {
        return UserPostModel::where('user_id')->first();
    }
}