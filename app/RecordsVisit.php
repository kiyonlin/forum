<?php

namespace App;


use Illuminate\Support\Facades\Redis;

trait RecordsVisit
{

    public function recordVisit()
    {
        Redis::incr($this->visitsCacheKey());

        return $this;
    }

    public function visits()
    {
        return Redis::get($this->visitsCacheKey()) ?? 0;
    }

    public function resetVisits()
    {
        Redis::del($this->visitsCacheKey());

        return $this;
    }

    /**
     * @return string
     */
    protected function visitsCacheKey(): string
    {
        return "threads.{$this->id}.visit";
    }
}