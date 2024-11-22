<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PrescriptionModel;

class AmountModel extends Model
{
    protected $table = 'amount';

    protected $primaryKey = 'AmountID';

    protected $fillable = [
        'PatientID',
        'PrescriptionID',
        'TotalAmount',
        'Deposit',
        'Balance',
        'MOP',
        'Payment',
        'created_at',
        'updated_at',
    ];

    public function prescription()
    {
        return $this->hasOne(PrescriptionModel::class, 'AmountID');
    }
}
