<?php

return [
    'auth_middleware' => \Webeleven\Rateable\Middleware\DefaultRateableAuth::class,
    'user_provider' => \Webeleven\Rateable\Services\DefaultUserProvider::class
];