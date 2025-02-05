<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserModel;
use App\Models\PatientModel;
use App\Models\AmountModel;

class PrescriptionModel extends Model
{
    protected $table = "prescriptions";
    protected $primaryKey = 'PrescriptionID';

    protected $fillable = [
        'PatientID',
        'DoctorID',
        'AmountID',
        'Lens',
        'LensType',
        'Frame',
        // 'Price',
        'Prescription',
        'PrescriptionDate',
        'PrescriptionDetails',
        'OUgrade',
        'OSgrade',
        'ODgrade',
        'ADD',
        'PD',
        'created_at',
        'updated_at',
    ];

    public function doctor()
    {
        return $this->belongsTo(UserModel::class, 'DoctorID')->where('usertype', 'ophthal');
    }

    public function amount()
    {
        return $this->belongsTo(AmountModel::class, 'AmountID');
    }
    // Define the relationship with the AppointmentModel using PatientID
    public function appointment()
    {
        return $this->hasOne(AppointmentModel::class, 'PatientID', 'PatientID');
    }

    // Define the relationship with the PatientModel
    public function patient()
    {
        return $this->belongsTo(PatientModel::class, 'PatientID', 'PatientID');
    }
}
