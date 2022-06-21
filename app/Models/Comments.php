<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $table = "comments";

    protected $fillable = ['id', 'id_incidencia', 'id_user', 'comment', 'comment_date'];

    public $timestamps = false;

    
    public static function obtenerComentariosDeIncidencia($id_incidencia){
        return Comments::where('id_incidencia',  $id_incidencia)->get(); 
    }

    public static function contarComentariosDeIncidencia($id_incidencia){
        return Comments::where('id_incidencia',  $id_incidencia)->count();
    }
}
