<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comments;
use App\Models\Users;

// Correo
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMail;
use App\Models\Incidencias;

class CommentsController extends Controller
{
    // Nueva Comentario
    protected $comentarios;

    public function __construct(Comments $comentarios)
    {
        $this->comentarios = $comentarios;
    }

    public function storeComment(Request $request)
    {
        $comentario = new Comments($request->all());
        $id_user = $request->id_user;
        $comentario->save();

        // Enviar correo (MODIFICAR)
        $user = Users::find($id_user);
        $incidencia = Incidencias::find($request->id_incidencia);
        
        if ($user['notify_email'] == "true") {
            Mail::to($user['email'])->send(new NotifyMail("comment", [$comentario, $user, $incidencia]));
        }

        return redirect("/incidence/info/$request->id_incidencia");
    }

    // Fin nuevo Comentario
}
