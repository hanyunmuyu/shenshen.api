<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2018/4/24
 * Time: 20:00
 */

namespace App\Http\Controllers\v1;


use App\Http\Controllers\Controller;
use App\Repositories\v1\ClubRepository;

class ClubController extends Controller
{

    private $clubRepository;
    /**
     * ClubController constructor.
     */
    public function __construct(ClubRepository $clubRepository)
    {
        $this->clubRepository = $clubRepository;
    }

    public function getClubList()
    {
        $clubList = $this->clubRepository->getClubList()->toArray();
        if ($clubList) {
            foreach ($clubList['data'] as $k => $list) {
                $clubList['data'][$k]['logo'] = env('APP_DOMAIN') . $list['logo'];
            }
        }
        return $this->success($clubList);
    }
}