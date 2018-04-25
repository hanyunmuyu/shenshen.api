<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2018/4/22
 * Time: 20:17
 */

namespace App\Http\Controllers\v1;


use App\Http\Controllers\Controller;
use App\Repositories\v1\SchoolRepository;

class SchoolController extends Controller
{

    private $schoolRepository;
    /**
     * SchoolController constructor.
     */
    public function __construct(SchoolRepository $schoolRepository)
    {
        $this->schoolRepository = $schoolRepository;
    }

    public function getSchoolList()
    {
        $schoolList = $this->schoolRepository->getSchoolList()->toArray();
        if ($schoolList) {
            foreach ($schoolList['data'] as $k=>$list) {
                $schoolList['data'][$k]['logo'] = config('api.api_domain') . $list['logo'];
            }
        }
        return $this->success($schoolList);
    }
}