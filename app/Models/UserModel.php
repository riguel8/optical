<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserModel extends Model
{
    use Notifiable;

    protected $table = "users";

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'usertype',
        'password',
        'created_at',
        'updated_at',
    ];

    public function appointments()
    {
        return $this->hasMany(AppointmentModel::class, 'StaffID');
    }

    public function prescription()
    {
        return $this->hasMany(PrescriptionModel::class,'DoctorID');
    }
}
