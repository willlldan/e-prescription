<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Racikan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = "racikan";

    public function obatalkes()
    {
        return $this->belongsToMany(ObatAlkes::class, 'racikan_obatalkes', 'racikan_id', 'obatalkes_id', 'id', 'obatalkes_id')->withPivot('qty');
    }
}
