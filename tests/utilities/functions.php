<?php

function create($class, $attributes = [], $times = null) {
    return factory($class, $times)->create($attributes);
}


function make($class, $attributes = [], $times = null) {
    return factory($class, $times)->make($attributes);
}

function page_url($subdomain = null, $path) {
    if(is_null($subdomain)) {
        return $path;

    }
    return "http://{$subdomain}.".env("APP_DOMAIN").$path;

}
