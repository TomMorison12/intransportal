<?php


namespace App;


trait RecordActivity
{
    protected static function bootRecordActivity()
    {
        foreach(static::getRecordEvents() as $event) {
            static::$event(function ($model) {
                $model->recordActivity($model);

            });
        }

}

    protected function recordActivity($event)
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event)
        ]);

    }

    protected static function getRecordEvents()
{
    return ['created'];

}


    public function activity() {
        return $this->morphMany('App\Activity', 'subject');
    }

    protected function getActivityType($event)
    {
        $type = strtolower((new \ReflectionClass($this))->getShortName());
        return "{$event}_{$type}";
    }
}
