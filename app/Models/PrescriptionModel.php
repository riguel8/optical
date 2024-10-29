<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserModel;
use App\Models\PatientModel;

class PrescriptionModel extends Model
{
    protected $table = "prescriptions";
    protected $primaryKey = 'PrescriptionID';

    protected $fillable = [
        'PatientID',
        'DoctorID',
        'Lens',
        'Frame',
        'Price',
        'Prescription',
        'PrescriptionDate',
        'PrescriptionDetails',
        'created_at',
        'updated_at',
    ];

    public function patient()
    {
        return $this->belongsTo(PatientModel::class, 'PatientID');
    }

    public function doctor()
    {
        return $this->belongsTo(UserModel::class, 'DoctorID')->where('usertype', 'ophthal');
    }
}
