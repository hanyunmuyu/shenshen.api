<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2018/4/16
 * Time: 21:33
 */

namespace App\Http\Controllers\v1;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $userName = $request->get('userName');
        $userPwd = $request->get('userPwd');
        if (!$userName) {
            return $this->error('用户名不可以为空！');
        }
        if (!$userPwd) {
            return $this->error('密码不可以为空！');
        }
        $user = new User();
        $res=$user->where('user_name', $userName)
            ->where('status',1)
            ->first();
        if (!$res) {
            return $this->error('该用户不存在！');
        }
        if ($res->user_password != md5($userPwd)) {
            return $this->error('密码错误！');
        }
        $token = md5(rand(1, 100));
        $res->api_token = $token;
        $res->last_login_ip = $request->getClientIp();
        $res->save();
        $data['token'] = $token;
        $data['user_name'] = $res->user_name;
        $data['avatar'] = config('api.api_domain') . $res->avatar;
        return $this->success($data);
    }
}