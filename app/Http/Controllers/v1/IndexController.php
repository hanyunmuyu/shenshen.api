<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2018/4/21
 * Time: 14:48
 */

namespace App\Http\Controllers\v1;


use App\Http\Controllers\Controller;
use App\Repositories\v1\ClubRepository;
use App\Repositories\v1\HomeRecommendRepository;
use App\Repositories\v1\SchoolRepository;
use App\Repositories\v1\UserPostRepository;
use App\Repositories\v1\UserRepository;

class IndexController extends Controller
{
    private $homeRecommendRepository;
    private $clubRepository;
    private $userRepository;
    private $schoolRepository;

    public function __construct(
        HomeRecommendRepository $homeRecommendRepository,
        ClubRepository $clubRepository,
        UserRepository $userRepository,
        SchoolRepository $schoolRepository
    )
    {
        $this->homeRecommendRepository = $homeRecommendRepository;
        $this->clubRepository = $clubRepository;
        $this->userRepository = $userRepository;
        $this->schoolRepository = $schoolRepository;
    }

    public function index()
    {
        $dataList = $this->homeRecommendRepository->getHomeRecommendList()->toArray();
        foreach ($dataList['data'] as $k => $val) {
            $dataList['data'][$k]['name'] = '';
            $dataList['data'][$k]['avatar'] = '';
            if ($val['tag'] == 'club') {
                $club = $this->clubRepository->getClubById($val['source_id']);
                if ($club) {
                    $dataList['data'][$k]['name'] = $club->name;
                    $dataList['data'][$k]['avatar'] = config('api.api_domain') . $club->logo;
                }
            } elseif ($val['tag'] == 'user_post') {
                $user = $this->userRepository->getUserByUserId($val['source_id']);
                if ($user) {
                    $dataList['data'][$k]['name'] = $user->user_name;
                    $dataList['data'][$k]['avatar']=config('api.api_domain') .$user->avatar;
                }
            } elseif ($val['tag'] == 'school') {
                $school = $this->schoolRepository->getSchoolBySchoolId($val['source_id']);
                if ($school) {
                    $dataList['data'][$k]['name'] = $school->name;
                    $dataList['data'][$k]['avatar']=config('api.api_domain') .$school->logo;
                }
            }

            $dataList['data'][$k]['img_a'] = config('api.api_domain') . $val['img_a'];
        }
        return $this->success($dataList);
    }
}