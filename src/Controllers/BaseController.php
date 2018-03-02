<?php

namespace Webeleven\Rateable\Controllers;

use Illuminate\Routing\Controller;

abstract class BaseController extends Controller
{

    protected function getLimit($data)
    {
        return isset($data['limit']) ? $data['limit'] : null;
    }

    protected function getSkip($data)
    {
        return isset($data['skip']) ? $data['skip'] : 0;
    }

}