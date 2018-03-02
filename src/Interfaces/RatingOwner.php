<?php

namespace Webeleven\Rateable\Interfaces;

interface RatingOwner
{
    public function getName();

    public function getId();

    public function getEmail();
}