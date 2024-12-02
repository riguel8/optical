<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use  App\Models\User;
use App\Models\PatientModel;
use Carbon\Carbon;

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

    //For calendar
    protected $casts = [
        'DateTime' => 'datetime',
    ];

    //For Foreign Keys
    public function patient()
    {
        return $this->belongsTo(PatientModel::class, 'PatientID', 'PatientID');
    }
    // public function staff()
    // {
    //     return $this->belongsTo(UserModel::class, 'id');
    // }
    public function staff()
    {
        return $this->belongsTo(UserModel::class, 'StaffID', 'id'); // StaffID is the FK to users.id
    }

}
