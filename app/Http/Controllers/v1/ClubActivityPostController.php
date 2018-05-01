<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28 0028
 * Time: 下午 17:25
 */

namespace App\Http\Controllers\v1;


use App\Http\Controllers\Controller;
use App\Repositories\v1\ClubActivityPostRepository;
use App\Repositories\v1\ClubActivityRepository;
use App\Repositories\v1\UserCollectionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClubActivityPostController extends Controller
{
    private $clubActivityPostRepository;
    private $userCollectionRepository;
    private $clubActivityRepository;
    public function __construct
    (
        ClubActivityPostRepository $clubActivityPostRepository,
        UserCollectionRepository $userCollectionRepository,
        ClubActivityRepository $clubActivityRepository
    )
    {
        $this->clubActivityPostRepository = $clubActivityPostRepository;
        $this->userCollectionRepository = $userCollectionRepository;
        $this->clubActivityRepository = $clubActivityRepository;
    }

    public function getClubActivityPostList(Request $request)
    {
        $clubActivityId = $request->get('id');
        $tag = $request->get('tag');
        if (!$tag) {
            return $this->error('tag不可以为空');
        }
        if (!$clubActivityId) {
            return $this->error('id不可以为空');
        }
        $postList = $this->clubActivityPostRepository->getClubActivityPostListByClubActivityId($clubActivityId)->toArray();
        $postList['isFavorite'] = 0;
        if (Auth::check()) {
            $user = Auth::user();
            $uid = $user->id;
            $collection = $this->userCollectionRepository->getCollection($uid, $tag, $clubActivityId);
            if ($collection) {
                $postList['isFavorite'] = 1;
            }
        }
        return $this->success($postList);
    }

    public function doPost(Request $request)
    {
        $activityId = $request->get('activityId');
        if (!$activityId) {
            return $this->error('id不可以为空！');
        }
        $activity = $this->clubActivityRepository->getClubActivityByActivityId($activityId);
        if (!$activity) {
            return $this->error('这个活动不存在！');
        }
        $content = $request->get('content');
        if (!$content) {
            return $this->error('内容不可以空！');
        }
        if (!Auth::check()) {
            return $this->error('请先登录！');
        }
        $data['content'] = $content;
        $data['activity_id'] = $activity->id;
        $data['club_id'] = $activity->club_id;
        $data['user_id'] = Auth::user()->id;
        $data['add_time'] = time();
        $res=$this->clubActivityPostRepository->addPost($data);
        if ($res) {
            return $this->success([]);
        }
        return $this->error('稍后重试！');
    }
}