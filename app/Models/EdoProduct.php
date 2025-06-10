<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EdoProduct extends Model
{
    protected $table = 'edo_product';

    protected $fillable = [
        'name',
        'description',
    ];
}