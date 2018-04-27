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

    public function addFavorite($sourceId, $tag, $uid)
    {
        $collection = $this->userCollectionRepository->getCollection($uid, $tag, $sourceId);
        if (!$collection) {
            $this->homeRecommendRepository->addFavorite($sourceId, $tag);
            return $this->userCollectionRepository->addCollection($sourceId, $tag, $uid);
        } else {
            $this->homeRecommendRepository->delFavorite($sourceId, $tag);
            return $this->userCollectionRepository->delCollection($sourceId, $tag, $uid);
        }
    }
}