<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/2 0002
 * Time: 下午 15:18
 */

namespace App\Http\Controllers\v1;


use App\Http\Controllers\Controller;
use App\Models\DistrictModel;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function getArea(Request $request)
    {
        $id = $request->get('id', 0);
        $level = $request->get('level', 1);
        $area = DistrictModel::where(function ($q) use ($id) {
            if ($id) {
                $q->where('upid', $id)->get();
            }
        })->where('level',$level)->get();
        return $this->success($area);
    }
}