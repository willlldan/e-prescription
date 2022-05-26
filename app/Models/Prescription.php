<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function racikan()
    {
        return $this->belongsToMany(Racikan::class, 'prescriptions_item', 'prescription_id', 'racikan_id', 'id', 'id')->withPivot('qty');
    }
    public function obatalkes()
    {
        return $this->belongsToMany(ObatAlkes::class, 'prescriptions_item', 'prescription_id', 'obatalkes_id', 'id', 'obatalkes_id')->withPivot('qty');
    }

    public function signa()
    {
        return $this->belongsToMany(Signa::class, 'prescriptions_item', 'prescription_id', 'signa_id', 'id', 'signa_id')->withPivot('qty');
    }
}
