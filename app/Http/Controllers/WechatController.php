<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \Log;

class WechatController extends Controller
{
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $wechat = app('wechat');
        $user = $wechat->user;
        $wechat->server->setMessageHandler(function($message) use ($user) {
            switch ($message->MsgType) {
                case 'event':
                    # 事件消息...
                    break;
                case 'text':
                    return 'Hello,' . $user->get($message->FromUserName)->nickname;
                    break;
                case 'image':
                    # 图片消息...
                    break;
                case 'voice':
                    # 语音消息...
                    break;
                case 'video':
                    # 视频消息...
                    break;
                case 'location':
                    # 坐标消息...
                    break;
                case 'link':
                    # 链接消息...
                    break;
                // ... 其它消息
                default:
                    # code...
                    break;
            }
        });

        Log::info('return response.');

        return $wechat->server->serve();
    }
}
