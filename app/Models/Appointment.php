<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';    protected $primaryKey = 'App_Id';
    protected $fillable = [
        'App_Date', 'App_Time', 'App_Duration','App_Price','App_Desc','App_Status'
    ];

    public function staff()
    {

        return $this->belongsToMany(Staff::class, 'appointment_staff', 'App_Id', 'Staff_Id')
            ->withPivot('Staff_Name')
            ->withTimestamps();
    }

}
