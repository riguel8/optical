<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use  App\Models\UserModel;
use App\Models\PatientModel;

class AppointmentModel extends Model
{
    protected $table = "appointments";

    protected $primaryKey = 'AppointmentID';

    protected $fillable = [
        'PatientID',
        'StaffID',
        'DateTime',
        'Status',
        'Notes',
        'created_at',
        'updated_at',
    ];


    //For Foreign Keys

    public function patient()
    {
        return $this->belongsTo(PatientModel::class, 'PatientID');
    }

    public function staff()
    {
        return $this->belongsTo(UserModel::class, 'id');
    }
}
