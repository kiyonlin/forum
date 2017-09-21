<?php

namespace App\Transformers;
/**
 * 具体使用
 * https://github.com/thephpleague/fractal
 * http://fractal.thephpleague.com/
 *
 * Class ThreadTransformer
 * @package App\Transformers
 */
class ThreadTransformer extends Transformer
{

    /**
     * Transform a specific thread
     *
     * @param $item
     * @return array
     */
    public function transform($thread)
    {
        return [
            'title' => $thread->title,
            'body'  => $thread->body,
        ];
    }
}