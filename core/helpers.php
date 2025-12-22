<?php

use App\Services\Authorization;

if (!function_exists("check")) {
    function check($action, $resource = null)
    {
        return Authorization::check($action, $resource);
    }
}
