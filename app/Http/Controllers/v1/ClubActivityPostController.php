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
use App\Repositories\v1\UserCollectionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClubActivityPostController extends Controller
{
    private $clubActivityPostRepository;
    private $userCollectionRepository;
    public function __construct
    (
        ClubActivityPostRepository $clubActivityPostRepository,
        UserCollectionRepository $userCollectionRepository
    )
    {
        $this->clubActivityPostRepository = $clubActivityPostRepository;
        $this->userCollectionRepository = $userCollectionRepository;
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
}