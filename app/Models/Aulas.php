<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aulas extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = "aulas";

    protected $fillable = ['id', 'aula'];

    public $timestamps = false;
    
    public function obtenerAulas()
    {
        return Aulas::all();
    }

    public function obtenerAulaPorID($id){
        return Aulas::find($id);
    }
}
