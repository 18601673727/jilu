<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

class WechatController extends Controller
{

    protected $wechat;

    public function __construct()
    {
        $this->wechat = app('wechat');
    }

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $this->wechat->server->setMessageHandler(function($message){
            return "欢迎关注\"记撸\"！";
        });

        Log::info('return response.');

        return $this->wechat->server->serve();
    }

    public function setMenu()
    {
        $buttons = [
            [
                "type" => "view",
                "name" => "进入应用",
                "url"  => "http://jilu.shmeta.com/"
            ],
            [
                "type" => "view",
                "name" => "我的记录",
                "url"  => "http://jilu.shmeta.com/me/"
            ],
        ];

        $this->wechat->menu->add($buttons);
    }
}
