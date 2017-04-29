<?php
function appendQueryString($params) {
    $query = Request::all();
    foreach ($params as $key => $value) {
        $query[$key] = $value;
    }
    return Request::url(). '?' . http_build_query($query);
}

function isQueryStringEqual($params) {
    return !array_diff($params, Request::all());
}
