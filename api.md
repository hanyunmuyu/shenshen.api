##1、注册
接口地址
```angular2html
/register
```
请求方式
```angular2html
post
```
参数
```angular2html
userName 用户名
userPwd 密码
confirmPwd 确认密码
```
curl
```angular2html
POST /api/v1/register HTTP/1.1
Host: 192.168.0.106:85
Content-Type: application/x-www-form-urlencoded
Cache-Control: no-cache
Postman-Token: cedfd099-b555-4c3a-ada3-1f67e1f0e865

userName=hanyun&userPwd=123456&confirmPwd=123456

```
返回值说明
```angular2html
token 用户的token
```
json格式
```angular2html
{
    "msg": "success",
    "code": 2000,
    "data": {
        "token": "eccbc87e4b5ce2fe28308fd9f2a7baf3"
    }
}
```

##2、登录
接口地址
```angular2html
/login
```
请求方式
```angular2html
post
```
参数
```angular2html
userName 用户名
userPwd 密码
```
curl
```angular2html
POST /api/v1/login HTTP/1.1
Host: 192.168.0.106:85
Cache-Control: no-cache
Postman-Token: 13659f09-ccc2-4721-b4b7-04c53d46cb86
Content-Type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW

------WebKitFormBoundary7MA4YWxkTrZu0gW
Content-Disposition: form-data; name="userName"

hanyun
------WebKitFormBoundary7MA4YWxkTrZu0gW
Content-Disposition: form-data; name="userPwd"

123456
------WebKitFormBoundary7MA4YWxkTrZu0gW--
```
返回值说明
```angular2html
token 用户的token
user_name 用户名
avatar 头像地址
```
json格式
```angular2html
{
    "msg": "success",
    "code": 2000,
    "data": {
        "token": "17e62166fc8586dfa4d1bc0e1742c08b",
        "user_name": "hanyun",
        "avatar": "http://192.168.0.106:85"
    }
}
```