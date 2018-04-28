<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2018/4/27
 * Time: 21:27
 */
trait Tools
{
    private function getImg()
    {
        $arr = [
            '/static/images/morning.jpg',
            '/static/images/vegetables.jpg',
            '/static/images/honey.jpg',
        ];
        $key=array_rand($arr);
        return $arr[$key];
    }
    private function getUserList()
    {
        return \App\User::where('status', 3)->orderBy(\Illuminate\Support\Facades\DB::raw('RAND()'))->get();
    }
}