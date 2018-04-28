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
use Illuminate\Http\Request;

class ClubActivityPostController extends Controller
{
    private $clubActivityPostRepository;
    public function __construct(ClubActivityPostRepository $clubActivityPostRepository)
    {
        $this->clubActivityPostRepository = $clubActivityPostRepository;
    }

    public function getClubActivityPostList(Request $request)
    {
        $clubActivityPostId = $request->get('id');
        $postList = $this->clubActivityPostRepository->getClubActivityPostListByClubActivityId($clubActivityPostId);
        return $this->success($postList->toArray());
    }
}