<?php
namespace App\Inspections;

class InvalidKeyword
{

    protected $keywords = [
        'some spam'
    ];

    public function detect($body)
    {
        foreach ($this->keywords as $keyword) {
            if (stripos($body, $keyword) !== false) {
                throw new \Exception('Your reply contains spam.');
            }
        }
    }
}