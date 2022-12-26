<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'uniq_id',
        'url',
        'text',
        'rating',
        'time_created',
        'uniq_id_bussiness',
        'bussiness_id'
    ];

    public function reviewuser()
    {
        return $this->belongsTo(Reviewuser::class);
    }
}
