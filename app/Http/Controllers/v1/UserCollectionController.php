<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2018/4/29
 * Time: 16:33
 */

namespace App\Http\Controllers\v1;


use App\Http\Controllers\Controller;
use App\Services\UserCollectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCollectionController extends Controller
{
    private $userCollectionService;
    public function __construct(UserCollectionService $userCollectionService)
    {
        $this->userCollectionService = $userCollectionService;
    }

    public function getUserCollection(Request $request)
    {
        $user=Auth::user();
        $userCollection = $this->userCollectionService->getUserCollectionByUserId($user->id);
        foreach ($userCollection['data'] as $k => $v) {
            $userCollection['data'][$k] = $v;
        }
        return $this->success($userCollection);
    }
}