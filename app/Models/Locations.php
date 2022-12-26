<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    use HasFactory;

    protected $fillable = [
        'address1',
        'address2',
        'address3',
        'city',
        'zip_code',
        'country',
        'state',
        'bussiness_id'
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
