<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencias extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_incidencia';

    protected $table = "incidencia";

    protected $fillable = ['id_incidencia', 'id_user', 'id_aula', 'create_date', 'update_date', 'close_date', 'title', 'description'];

    public $timestamps = false;
    
    public function obtenerIncidencias()
    {
        // Obtener todas las incidencias de todos los usuarios
        return Incidencias::all(); 
    }

    public function obtenerIncidenciaPorID($id_incidencia){
        // Info de la incidencia según el ID
        return Incidencias::find($id_incidencia);
    }

    public function obtenerIncidenciasAbiertasPorID($id_user){
        // Solo incidencias abiertas y cerradas
        return Incidencias::where('id_user',  $id_user)
                          ->where('state', '!=', "closed")
                          ->get(); 
    }

    public function obtenerIncidenciaPorIDUser($id_user){
        // Todas las incidencias del usuario
        return Incidencias::where('id_user',  $id_user)->get(); 
    }
}
