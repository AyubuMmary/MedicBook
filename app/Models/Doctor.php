<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'user_id',
        'specialization',
        'qualification',
        'experience',
        'consultation_fee',
        'bio',
        'photo',
        'gender',
        'is_available',
    ];

    protected $casts = [
        'is_available'     => 'boolean',
        'consultation_fee' => 'decimal:2',
        'experience'       => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    // Helper: get experience label
    public function getExperienceLabelAttribute()
    {
        if (!$this->experience) return 'N/A';
        return $this->experience . ' ' . ($this->experience === 1 ? 'Year' : 'Years');
    }

    // Helper: get gender icon
    public function getGenderIconAttribute()
    {
        return $this->gender === 'female' ? '👩‍⚕️' : '👨‍⚕️';
    }
}