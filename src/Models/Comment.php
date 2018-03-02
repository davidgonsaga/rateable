<?php

namespace Webeleven\Rateable\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table = 'webeleven_comments';
    protected $fillable = ['rating_id', 'title', 'description', 'published'];

    public function rate()
    {
        return $this->hasOne(Rate::class, 'id', 'rating_id');
    }

}