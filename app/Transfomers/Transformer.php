<?php

namespace App\Transformers;
/**
 * 具体使用
 * https://github.com/thephpleague/fractal
 * http://fractal.thephpleague.com/
 *
 * Class Transformer
 * @package App\Transformers
 */
abstract class Transformer
{

    /**
     * Transform a collection of items
     *
     * @param array $items
     * @return array
     */
    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    /**
     * Transform a specific item
     *
     * @param $item
     * @return array
     */
    public abstract function transform($item);
}