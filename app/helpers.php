<?php


if (! function_exists('is_impersonating')) {
    function is_impersonating():bool {
        return session()->has(config('laravel-impersonate.session_key'));
    }
}
