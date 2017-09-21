<?php

namespace App\Transformers;

class ExampleTransformer extends Transformer
{

    /**
     * Transform a specific item
     *
     * @param $item
     * @return array
     */
    public function transform($item)
    {
        return [
            'attribute' => $item->attribute,
        ];
    }
}