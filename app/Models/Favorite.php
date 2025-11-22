<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Listing;


class Favorite extends Model
{
    protected $fillable = [
        'user_id',
        'listing_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }
}
