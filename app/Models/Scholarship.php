<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'scholarship_name',
        'award_amount',
        'country',
        'eligibility_criteria',
        'application_description',
        'application_requirements', // Make sure this is in your fillable array
        'application_deadline',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'application_requirements' => 'array',
        'application_deadline' => 'date',
    ];

    public function images()
    {
        return $this->hasMany(\App\Models\ScholarshipImage::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
