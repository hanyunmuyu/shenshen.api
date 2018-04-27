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
use App\Repositories\v1\UserCollectionRepository;
use App\Repositories\v1\UserPostRepository;
use App\Repositories\v1\UserRepository;
use App\Services\HomeRecommendService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    private $homeRecommendRepository;
    private $clubRepository;
    private $userRepository;
    private $schoolRepository;
    private $homeRecommendService;
    private $userCollectionRepository;
    public function __construct(
        HomeRecommendRepository $homeRecommendRepository,
        ClubRepository $clubRepository,
        UserRepository $userRepository,
        SchoolRepository $schoolRepository,
        HomeRecommendService $homeRecommendService,
        UserCollectionRepository $userCollectionRepository
    )
    {
        $this->homeRecommendRepository = $homeRecommendRepository;
        $this->clubRepository = $clubRepository;
        $this->userRepository = $userRepository;
        $this->schoolRepository = $schoolRepository;
        $this->homeRecommendService = $homeRecommendService;
        $this->userCollectionRepository = $userCollectionRepository;
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
                    $dataList['data'][$k]['avatar'] = config('api.api_domain') . $user->avatar;
                }
            } elseif ($val['tag'] == 'school') {
                $school = $this->schoolRepository->getSchoolBySchoolId($val['source_id']);
                if ($school) {
                    $dataList['data'][$k]['name'] = $school->name;
                    $dataList['data'][$k]['avatar'] = config('api.api_domain') . $school->logo;
                }
            }
            $imgList = [];
            if ($val['img_a']) {
                $imgList[] = config('api.api_domain') . $val['img_a'];
                unset($dataList['data'][$k]['img_a']);
            }
            if ($val['img_b']) {
                $imgList[] = config('api.api_domain') . $val['img_b'];
                unset($dataList['data'][$k]['img_b']);
            }
            if ($val['img_c']) {
                $imgList[] = config('api.api_domain') . $val['img_c'];
                unset($dataList['data'][$k]['img_c']);
            }
            $dataList['data'][$k]['imgList'] = $imgList;
        }
        return $this->success($dataList);
    }

    public function addClickNumber(Request $request)
    {
        $id = $request->get('id');
        if (!$id) {
            return $this->error('id不可以为空');
        }
        $res = $this->homeRecommendRepository->addClickNumber($id);
        if ($res) {
            return $this->success([]);
        }
        return $this->error('');
    }

    public function addFavorite(Request $request)
    {
        $id = $request->get('id');
        $tag = $request->get('tag');
        if (!$id) {
            return $this->error('id不可以为空');
        }
        if (!$tag) {
            return $this->error('tag不可以为空');
        }
        if (!Auth::check()) {
            return $this->error('清先登录！');
        }
        $user = Auth::user();
        $uid = $user->id;
        $res = $this->homeRecommendService->addFavorite($id, $tag, $uid);
        if ($res) {
            return $this->success([]);
        }
        return $this->error('操作失败！');
    }

    public function getUserCollectionById(Request $request)
    {
        $id = $request->get('id');
        $tag = $request->get('tag');
        if (!$tag) {
            return $this->error('tag不可以为空');
        }
        if (!$id) {
            return $this->error('id不可以为空');
        }
        if (!Auth::check()) {
            return $this->error('请先登录！');
        }
        $user = Auth::user();
        $uid = $user->id;
        $collection=$this->userCollectionRepository->getCollection($uid,$tag, $id);
        if ($collection) {
            return $this->success(['favorite' => 1]);
        }
        return $this->success(['favorite' => 0]);
    }
}