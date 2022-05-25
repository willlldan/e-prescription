<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObatAlkes extends Model
{
    use HasFactory;

    protected $guarded = ['obatalkes_id'];

    protected $table = 'obatalkes_m';
}
