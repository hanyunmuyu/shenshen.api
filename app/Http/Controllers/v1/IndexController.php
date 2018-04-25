<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2018/4/21
 * Time: 14:48
 */

namespace App\Http\Controllers\v1;


use App\Http\Controllers\Controller;
use App\Repositories\v1\HomeRecommendRepository;

class IndexController extends Controller
{
    private $homeRecommendRepository;
    /**
     * IndexController constructor.
     */
    public function __construct(HomeRecommendRepository $homeRecommendRepository)
    {
        $this->homeRecommendRepository = $homeRecommendRepository;
    }

    public function index()
    {
        $data = [];
        for ($i = 0; $i < 16; $i++) {
            $tmp=[];
            $imgList = [
                '/static/images/hats.jpg',
                '/static/images/breakfast.jpg',
                '/static/images/camera.jpg'
            ];
            $tmp['avatar'] = '/static/hats.jpg';
            $tmp['title'] = '河南工业大学';
            $tmp['username'] = '寒云';
            $tmp['description'] = '河南工业大学简介河南工业大学简介河南工业大学简介河南工业大学简介河南工业大学简介河南工业大学简介河南工业大学简介河南工业大学简介';
            $tmp['imgList'] = $imgList;
            $tmp['clickNum'] = 10000;
            $tmp['favoriteNum'] = 100;
            $tmp['userId'] = $i + 1;
            $data[] = $tmp;
        }
        $dataList = $this->homeRecommendRepository->getHomeRecommendList()->toArray();
        foreach ($dataList['data'] as $k => $val) {
            $dataList['data'][$k]['img_a'] = config('api.api_domain').$val['img_a'];
        }
        return $this->success($dataList);
    }
}