<?php

namespace App;


trait RecordsActivity
{

    /**
     * boot+trait名称，使用该trait的类会触发boot
     */
    protected static function bootRecordsActivity()
    {
        if (auth()->guest()) return;

        foreach (static::getActivitiesToRecord() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }
    }

    protected function recordActivity($event)
    {
        $this->activity()->create([
            'type'    => $this->getActivityType($event),
            'user_id' => auth()->id()
        ]);
    }

    protected static function getActivitiesToRecord()
    {
        // 必须和laravel的事件名称一致
        return ['created'];
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    /**
     * @param $event
     * @return string
     */
    protected function getActivityType($event): string
    {
        $type = strtolower((new \ReflectionClass($this))->getShortName());

        return $event . '_' . $type;
    }
}