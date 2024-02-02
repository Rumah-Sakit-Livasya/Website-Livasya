<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplierWork extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function applier()
    {
        return $this->belongsTo(Applier::class);
    }
}
