<?php

namespace Webeleven\Rateable\Models;

abstract class CommentPublishStatus
{
    const PUBLISHED = 1;
    const NOT_PUBLISHED = 0;

    public static function getStatuses()
    {
        return [
            CommentPublishStatus::PUBLISHED => 'Publicado',
            CommentPublishStatus::NOT_PUBLISHED => 'Não Publicado'
        ];
    }
}