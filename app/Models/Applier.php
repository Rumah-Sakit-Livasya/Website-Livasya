<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applier extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    public function works()
    {
        return $this->hasMany(ApplierWork::class);
    }

    public function languages()
    {
        return $this->hasMany(ApplierLanguage::class);
    }

    public function certifications()
    {
        return $this->hasMany(ApplierCertification::class);
    }
}
