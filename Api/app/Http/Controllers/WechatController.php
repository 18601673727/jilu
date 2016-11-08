<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use App\User;

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
        $this->wechat->server->setMessageHandler(function($message) {
            if ($message->MsgType == 'event') {
                switch ($message->Event) {
                    case 'subscribe':
                        return "欢迎关注\"记撸\"！";
                        break;
                    case 'LOCATION':
                        $user = User::where('wechat_id', $message->FromUserName)->first();
                        $user->location = [
                            'latitude' => $message->Latitude,
                            'longitude' => $message->Longitude,
                            'precision' => $message->Precision,
                        ];
                        $user->save();
                        break;
                    default:
                        Log::info('>>>>> Un-catched Event Type: '.$message->Event);
                        break;
                }
            }
        });

        return $this->wechat->server->serve();
    }

    public function setMenu()
    {
        $buttons = [
            [
                "type" => "view",
                "name" => "进入应用",
                "url"  => "http://jilu.shmeta.com/events/create"
            ],
            [
                "type" => "view",
                "name" => "我的记录",
                "url"  => "http://jilu.shmeta.com/events/"
            ],
        ];

        $this->wechat->menu->add($buttons);
    }
}
