<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scholarship;

class ScholarshipImage extends Model
{
    protected $fillable = [
        'scholarship_id',
        'image_path',
    ];

    public function scholarship()
    {
        return $this->belongsTo(Scholarship::class);
    }
}
