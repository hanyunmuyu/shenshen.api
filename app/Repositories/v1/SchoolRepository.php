<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2018/4/22
 * Time: 20:18
 */

namespace App\Repositories\v1;


use App\Models\SchoolModel;

class SchoolRepository
{
    public function getSchoolList()
    {
        return SchoolModel::where('status', 3)->orderBy('id','desc')->paginate(15);
    }
}