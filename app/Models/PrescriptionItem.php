<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionItem extends Model
{
    use HasFactory;

    protected $guarded = "id";

    protected $table = "prescriptions_item";

    public function racikan()
    {
        return $this->hasOne(Racikan::class, 'id', 'racikan_id');
    }

    public function obatalkes()
    {
        return $this->hasOne(obatalkes::class, 'obatalkes_id', 'obatalkes_id');
    }

    public function signa()
    {
        return $this->hasOne(Signa::class, 'signa_id', 'signa_id');
    }
}
