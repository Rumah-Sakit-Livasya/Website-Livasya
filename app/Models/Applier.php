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
        return $this->hasMany(ApplierWork::class, 'applier_id');
    }

    public function languages()
    {
        return $this->hasMany(ApplierLanguage::class);
    }

    public function certifications()
    {
        return $this->hasMany(ApplierCertification::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scholarships()
    {
        return $this->hasMany(ApplierScholarship::class);
    }

    public function licenses()
    {
        return $this->hasMany(ApplierLicense::class);
    }

    public function others()
    {
        return $this->hasMany(ApplierOther::class);
    }

    public function educations()
    {
        return $this->hasMany(ApplierEducation::class);
    }
}
