<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'email',
        'birth_date',
        'gender',
        'address',
        'state',
        'country',
        'pin_code',
        'phone_number',
        'department',
        'designation',
        'reports_to',
    ];
    public function department()
    {
        return $this->belongsTo(Department::class, 'department', 'id');
    }
    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation', 'id');
    }
}
