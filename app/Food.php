<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    /* Relationship Methods */
    public function users()
    {
        # With timetsamps() will ensure the pivot table has its created_at/updated_at fields automatically maintained
        return $this->belongsToMany('App\User')->withTimestamps();
    }
    /* End Relationship Methods */
}
