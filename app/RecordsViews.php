<?php


namespace App;


use Illuminate\Support\Facades\Redis;

trait RecordsViews
{

    public function resetViews()
    {


        return $this;
    }

    public function recordView()
    {

        return $this;
    }


    public function views()
    {
        return new Views($this);
    }
}
