<?php

function create($class, $attributes = [], $times = 1)
{
     if($times > 1)
        return app($class)->factory()->count($times)->create($attributes);
    return app($class)->factory()->create($attributes);
}

function make($class, $attributes = [], $times = 1)
{
    if($times > 1)

        return app($class)->factory()->count($times)->make($attributes);
    return app($class)->factory()->make($attributes);
}

function page_url($subdomain, $path)
{
    if (is_null($subdomain)) {
        $domain = parse_url(config('app.url'), PHP_URL_HOST);

        return 'http://'.$domain.$path;
    }

    return "http://{$subdomain}.".env('APP_DOMAIN').'/'.$path;
}
