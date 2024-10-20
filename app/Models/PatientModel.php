<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientModel extends Model
{
    protected $table = 'patients';

    protected $primaryKey = 'PatientID';

    protected $fillable = [
        'complete_name',
        'gender',
        'age',
        'contact_number',
        'address',
        'created_at',
        'updated_at',
    ];

    public function appointments()
    {
        return $this->hasMany(AppointmentModel::class, 'PatientID');
    }


}
