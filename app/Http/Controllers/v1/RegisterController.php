<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 2018/4/28
 * Time: 20:56
 */

namespace App\Http\Controllers\v1;


use App\Http\Controllers\Controller;
use App\Repositories\v1\UserRepository;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(Request $request)
    {
        $userName = $request->get('userName');
        $userPwd = $request->get('userPwd');
        $userConfirmPwd = $request->get('confirmPwd');
        if (!$userName) {
            return $this->error('用户名不可以为空！');
        }
        if (!$userPwd) {
            return $this->error('密码不可以为空！');
        }
        if (!$userPwd!=$userConfirmPwd) {
            return $this->error('密码两次要一致！');
        }
        $user = $this->userRepository->getUserByUserName($userName);
        if ($user) {
            return $this->error('用户已经存在！');
        }
        $token = md5(rand(1, 100));
        $data['api_token'] = $token;
        $data['user_name'] = $userName;
        $data['user_password'] = md5($userPwd);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['last_login_ip'] = $request->getClientIp();
        $res=$this->userRepository->addUser($data);
        if ($res) {
            return $this->success(['token' => $token]);
        }
        return $this->error('请稍后重试！');
    }
}