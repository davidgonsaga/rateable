<?php

namespace Webeleven\Rateable\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{

    protected $table = 'webeleven_ratings';
    protected $fillable = ['resource_id', 'resource_type', 'owner_id', 'owner_name', 'owner_email', 'rating'];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'webeleven_comments.rating_id', 'webeleven_rates.id');
    }

    public function getResourceResolver()
    {
        $resolverEntity = config('rateable.resource_resolver');

        if (empty($resolverEntity)) {
            throw new \Exception('Resource Resolver is not valid');
        }

        return app($resolverEntity)->getResolver();
    }

    public function getResource()
    {
        $resolver = $this->getResourceResolver();

        return $resolver($this);
    }

}
