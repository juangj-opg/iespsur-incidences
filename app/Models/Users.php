<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = "users";

    protected $fillable = ['user', 'id', 'email', 'password', 'rol', 'validated', 'first_name', 'last_name', 'dni', 'tel', 'gender', 'last_login', 'last_update', 'create_date', 'notify_email'];

    public $timestamps = false;
    
    protected $hidden = [
        'password'
    ];

    public function obtenerUsuarios()
    {
        return Users::all();
    }

    public static function obtenerUsuarioPorID($id){
        return Users::find($id);
    }
}
