<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
