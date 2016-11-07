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
        $this->wechat->server->setMessageHandler(function($message) {
            if ($message->MsgType == 'event') {
                Log::info(json_encode([
                    'latitude' => $message->Latitude,
                    'longitude' => $message->Longitude,
                    'precision' => $message->Precision,
                    'id' => auth()->user()->id,
                ]));

                switch ($message->Event) {
                    case 'subscribe':
                        return "欢迎关注\"记撸\"！";
                        break;
                    case 'location':
                        auth()->user()->locations()->save([
                            'latitude' => $message->Latitude,
                            'longitude' => $message->Longitude,
                            'precision' => $message->Precision,
                        ]);
                        break;
                    default:
                        # code...
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
