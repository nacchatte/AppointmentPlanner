<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';
    protected $primaryKey = 'Customer_Id';
    protected $fillable = [
        'Customer_Name', 'Customer_HP', 'Customer_Address',
    ];
}
