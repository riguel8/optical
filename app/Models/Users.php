<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users'; 
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'usertype',
        'password',
        'created_at',
        'updated_at',
    ];

    // Fetch all users
    public static function getUsers()
    {
        return self::all();
    }

    // Fetch a user by ID
    public static function getUserById($userId)
    {
        return self::find($userId);
    }

    // Fetch a user with the image by ID
    public static function getUserWithImage($userId)
    {
        return self::select('id', 'name', 'email')
                    ->where('id', $userId)
                    ->first();
    }

    // Authenticate user
    public static function authenticate($email, $password)
    {
        $user = self::where('email', $email)
                    ->where('password', $password) // Ideally use hashed passwords and `Hash::check`
                    ->first();
                    
        return $user ?: false;
    }

    // Register a new user
    public static function registerUser($userData)
    {
        return self::create($userData);
    }


    public function appointments()
    {
        return $this->hasMany(AppointmentModel::class, 'StaffID');
    }

    public function prescription()
    {
        return $this->hasMany(PrescriptionModel::class,'DoctorID');
    }
}
