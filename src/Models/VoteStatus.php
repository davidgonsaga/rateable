<?php

namespace Webeleven\Rateable\Models;


abstract class VoteStatus
{
    const NOT_VOTED = 0;
    const POSITIVE_VOTED = 1;
    const NEGATIVE_VOTED = 2;
}