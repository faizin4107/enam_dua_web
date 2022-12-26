<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bussiness extends Model
{
    use HasFactory;
    // protected $table = 'bussinesses';
    protected $fillable = [
        'uniq_id',
        'alias',
        'name',
        'image_url',
        'is_closed',
        'url',
        'review_count',
        'rating',
        'price',
        'phone',
        'display_phone',
        'distance'
    ];

    public function categories()
    {
        return $this->hasMany(Categories::class);
        // return $this->belongsTo('App\Models\Categories', 'foreign_key', 'bussiness_id');
    }

    public function coordinates()
    {
        return $this->hasMany(Coordinates::class);
    }

    public function locations()
    {
        return $this->hasMany(Locations::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transactions::class);
    }

}
