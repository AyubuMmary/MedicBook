<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'phone'];

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function isAdmin()   { return $this->role === 'admin'; }
    public function isDoctor()  { return $this->role === 'doctor'; }
    public function isPatient() { return $this->role === 'patient'; }
}