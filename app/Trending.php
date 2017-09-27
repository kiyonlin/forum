<?php
/**
 * Created by PhpStorm.
 * User: kiyon
 * Date: 27/09/2017
 * Time: 1:17 PM
 */

namespace App;


use Illuminate\Support\Facades\Redis;

class Trending
{

    public function get()
    {
        return array_map('json_decode', Redis::zrevrange($this->cacheKey(), 0, 4));
    }

    public function push($thread)
    {
        Redis::zincrby($this->cacheKey(), 1, json_encode([
            'title' => $thread->title,
            'path'  => $thread->path(),
        ]));
    }

    /**
     * @return string
     */
    public function cacheKey(): string
    {
        return app()->environment('testing') ? 'testing_trending_threads' : 'trending_threads';
    }

    public function reset()
    {
        Redis::del($this->cacheKey());
    }
}