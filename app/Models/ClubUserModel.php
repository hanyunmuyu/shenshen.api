<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28 0028
 * Time: 上午 11:20
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ClubUserModel extends Model
{
    protected $table = 'club_has_user';
    public $timestamps = false;
}