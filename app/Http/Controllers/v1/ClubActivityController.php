<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/26 0026
 * Time: 下午 15:25
 */

namespace App\Http\Controllers\v1;


use App\Http\Controllers\Controller;
use App\Repositories\v1\ClubActivityRepository;
use App\Repositories\v1\ClubRepository;
use Illuminate\Http\Request;

class ClubActivityController extends Controller
{
    private $clubActivityRepository;
    private $clubRepository;
    public function __construct(
        ClubActivityRepository $clubActivityRepository,
        ClubRepository $clubRepository
    )
    {
        $this->clubActivityRepository = $clubActivityRepository;
        $this->clubRepository = $clubRepository;
    }

    public function getClubNewActivity(Request $request)
    {
        $clubId = $request->get('clubId');
        if (!$clubId) {
            return $this->error('clubId 不可以为空！');
        }
        $club = $this->clubRepository->getClubById($clubId);
        if (!$club) {
            return $this->error('该社团不存在！');
        }
        $detail['name'] = $club->name;
        $detail['logo'] = config('api.api_domain') . $club->logo;
        $detail['description'] = $club->description;
        $dataList = $this->clubActivityRepository->getClubNewActivity($clubId)->toArray();
        foreach ($dataList['data'] as $key => $val) {

        }
        $dataList['detail'] = $detail;
        return $this->success($dataList);
    }
}