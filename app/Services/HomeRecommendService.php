<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27 0027
 * Time: 下午 12:31
 */

namespace App\Services;


use App\Repositories\v1\HomeRecommendRepository;
use App\Repositories\v1\UserCollectionRepository;

class HomeRecommendService
{
    private $homeRecommendRepository;
    private $userCollectionRepository;

    public function __construct(
        HomeRecommendRepository $homeRecommendRepository,
        UserCollectionRepository $userCollectionRepository
    )
    {
        $this->homeRecommendRepository = $homeRecommendRepository;
        $this->userCollectionRepository = $userCollectionRepository;
    }

    public function addFavorite($id, $tag, $uid)
    {
        $collection = $this->userCollectionRepository->getCollection($uid, $id);
        if (!$collection) {
            $this->homeRecommendRepository->addFavorite($id);
            return $this->userCollectionRepository->addCollection($id, $tag, $uid);
        }else{
            $this->homeRecommendRepository->delFavorite($id);
            return $this->userCollectionRepository->delCollection($uid, $id);
        }
    }
}