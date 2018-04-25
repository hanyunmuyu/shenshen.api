<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2018/4/25
 * Time: 21:16
 */

namespace App\Http\Controllers\v1;


use App\Http\Controllers\Controller;
use App\Repositories\v1\SchoolClassRepository;

class SchoolClassController extends Controller
{
    private $schoolClassRepository;
    /**
     * SchoolClassController constructor.
     */
    public function __construct(SchoolClassRepository $schoolClassRepository)
    {
        $this->schoolClassRepository = $schoolClassRepository;
    }

    public function getSchoolClassList()
    {
        $dataList = $this->schoolClassRepository->getSchoolClassList()->toArray();
        foreach ($dataList['data'] as $k=>$value) {
            $dataList['data'][$k] = $value;
        }
        return $this->success($dataList);
    }
}