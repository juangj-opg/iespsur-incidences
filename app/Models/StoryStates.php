<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryStates extends Model
{
    use HasFactory;

    protected $table = "story_state";

    protected $fillable = ['id', 'id_incidencia', 'state', 'story_date'];

    public $timestamps = false;

    public static function obtenerHistorialEstadoDeIncidencia($id_incidencia){
        return StoryStates::where('id_incidencia',  $id_incidencia)->get(); 
    }
}
