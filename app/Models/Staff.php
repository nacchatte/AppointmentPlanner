<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staff';
    protected $primaryKey = 'Staff_Id';
    protected $fillable = ['Staff_Name', 'Staff_HP', 'Staff_Address'];

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_staff', 'Staff_Id', 'App_Id')
            ->withPivot('Staff_Name')
            ->withTimestamps();
    }

}
