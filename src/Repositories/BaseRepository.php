<?php

namespace Webeleven\Rateable\Repositories;

abstract class BaseRepository
{
    protected function applyLimitAndOffsetIfNecessary($query, $limit, $skip)
    {

        if ($skip > 0) {
            $query->skip($skip);
        }

        if (! empty($limit)) {
            $query->take($limit);
        }

        return $query;

    }
}