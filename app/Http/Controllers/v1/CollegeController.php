<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/3 0003
 * Time: 下午 16:09
 */

namespace App\Http\Controllers\v1;


use App\Http\Controllers\Controller;
use App\Models\CollegeModel;

class CollegeController extends Controller
{
    public function getCollegeList()
    {
        return $this->success(CollegeModel::limit(20)->get()->toArray());
    }
}