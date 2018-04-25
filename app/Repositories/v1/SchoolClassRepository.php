<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2018/4/25
 * Time: 21:18
 */

namespace App\Repositories\v1;


use App\Models\SchoolClassModel;

class SchoolClassRepository
{
    public function getSchoolClassList()
    {
        return SchoolClassModel::orderBy('id', 'desc')->paginate(16);
    }
}