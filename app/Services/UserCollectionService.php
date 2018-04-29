<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2018/4/28
 * Time: 22:20
 */

namespace App\Services;


use App\Models\UserCollectionModel;
use App\Repositories\v1\ClubActivityRepository;

class UserCollectionService
{
    private $clubActivityRepository;
    public function __construct(ClubActivityRepository $clubActivityRepository)
    {
        $this->clubActivityRepository = $clubActivityRepository;
    }

    public function getUserCollectionByUserId($uid)
    {
        $dataList=UserCollectionModel::where('user_id', $uid)
            ->orderBy('id','desc')
            ->paginate(16)
            ->toArray();
        $clubActivityListMap = [];
        if ($dataList) {
            $clubActivityIdList = [];

            foreach ($dataList['data'] as $list) {
                if ($list['tag'] == 'club') {
                    $clubActivityIdList[] = $list['source_id'];
                }
            }
            if ($clubActivityIdList) {
                $clubActivityList=$this->clubActivityRepository->getClubActivityByIds($clubActivityIdList)->toArray();
                if ($clubActivityList) {
                    foreach ($clubActivityList as $clubActivity) {
                        $clubActivity['source_id'] = $clubActivity['id'];
                        $clubActivity['description'] = $clubActivity['content'];
                        $clubActivity['avatar'] = config('api.api_domain') . $clubActivity['logo'];
                        $clubActivity['imgList'] = [];
                        unset($clubActivity['content'], $clubActivity['logo']);
                        $clubActivityListMap[$clubActivity['id']] = $clubActivity;
                    }
                }
            }
        }
        foreach ($dataList['data'] as $key=>$val) {
            if ($val['tag'] == 'club') {
                if (isset($clubActivityListMap[$val['source_id']])) {
                    $dataList['data'][$key] = array_merge($val,$clubActivityListMap[$val['source_id']]);
                }else{
                    unset($dataList['data'][$key]);
                }
            }
        }
        return $dataList;
    }
}