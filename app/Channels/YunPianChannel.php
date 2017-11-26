<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Knox\Utils\TimeLength;

class YunPianChannel
{
    protected $yunPian;

    /**
     * Create a new YunPian channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->yunPian = '';
    }

    /**
     * 使用云片发送短信通知
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $to = $notifiable->mobile) {
            return;
        }

        $message = $notification->toYunPian($notifiable);

        $from = $message['from'] ?: config('services.yunpian.sms_from');

        $this->yunPian->send($from, $to, $message['content']);
    }
}