<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplierEducation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'applier_educations';

    public function applier()
    {
        return $this->belongsTo(Applier::class);
    }
}
