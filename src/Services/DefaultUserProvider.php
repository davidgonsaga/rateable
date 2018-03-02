<?php

namespace Webeleven\Rateable\Services;

use Illuminate\Support\Facades\Auth;
use Webeleven\Rateable\Interfaces\UserProvider;

class DefaultUserProvider implements UserProvider
{

    public function getUser()
    {
        return Auth::user();
    }
}