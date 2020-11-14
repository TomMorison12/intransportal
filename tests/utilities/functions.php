
<?php

function create($class, $attributes = [], $times = null)
{
    return factory($class, $times)->create($attributes);
}

function make($class, $attributes = [], $times = null)
{
    return factory($class, $times)->make($attributes);
}

function page_url($subdomain, $path)
{
    if (is_null($subdomain)) {
        $domain = parse_url(config('app.url'), PHP_URL_HOST);

        return 'http://'.$domain.$path;
    }

    return "http://{$subdomain}.".env('APP_DOMAIN').'/'.$path;
}
