<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviewuser extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'uniq_id',
        'profile_url',
        'image_url',
        'name',
        'review_id'
    ];

}
