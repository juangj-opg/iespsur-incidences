<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Incidencias;
use App\Models\Aulas;

// Correo
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMail;

use App\Models\Users;
use App\Models\Comments;
use App\Models\StoryStates;
use Illuminate\Support\Facades\Auth;

class IncidenceController extends Controller
{
    protected $incidencias;

    public function __construct(Incidencias $incidencias)
    {
        $this->incidencias = $incidencias;
    }

    public function index()
    {
        $data['incidencias'] = $this->incidencias->obtenerIncidencias();
        $data['aulas'] = Aulas::all();
        return view('incidences.listIncidences', ['data' => $data]);
    }

    public function openIncidences($id_user)
    {
        $data['incidencias'] = $this->incidencias->obtenerIncidenciasAbiertasPorID($id_user);
        $data['aulas'] = Aulas::all();

        //$data['comments'] = Comments::contarComentariosDeIncidencia();

        // Para calcular cuantos comentarios tiene esa incidencia
        for ($i = 0; $i < count($data['incidencias']); $i++) {
            $data['incidencias'][$i]['comentarios'] = Comments::contarComentariosDeIncidencia($data['incidencias'][$i]['id_incidencia']);
            $data['incidencias'][$i]['usuario'] = Users::obtenerUsuarioPorID($data['incidencias'][$i]['id_user']);
        }
        return view('incidences.openIncidences', ['data' => $data]);
    }

    public function userIncidenceHistory($id_user)
    {
        $data['incidencias'] = $this->incidencias->obtenerIncidenciaPorIDUser($id_user);
        $data['aulas'] = Aulas::all();
        return view('incidences.userHistory', ['data' => $data]);
    }

    public function newIncidence()
    {
        $data['aulas'] = Aulas::all();
        return view('incidences.newIncidence', ['data' => $data]);
    }

    public function storeIncidence(Request $request)
    {
        // Guardar datos en la BD
        $incidencia = new Incidencias($request->all());
        $incidencia->save();

        // Añadir un historial (new) de StoryState al crear la Incidencia
        $storyState = new StoryStates(['id_incidencia' => $incidencia['id_incidencia']]);
        $storyState->save();

        // Enviar correo
        $user = Auth::user();
        Mail::to($user['email'])->send(new NotifyMail("new", [$incidencia, $user]));

        return redirect('/incidence/info/' . $incidencia['id_incidencia']);
    }

    public function infoIncidence($id_incidencia)
    {
        $data['incidencia'] = $this->incidencias->obtenerIncidenciaPorID($id_incidencia);
        $data['aulas'] = Aulas::all();
        $data['user'] = Users::find($data['incidencia']['id_user']);
        $data['fechaCreacion'] = date('d-m-Y', strtotime($data['incidencia']['create_date']))
            . " a las "
            . date('G:i:s', strtotime($data['incidencia']['create_date']));


        $data['historial'] = [];
        $comentarios = Comments::obtenerComentariosDeIncidencia($id_incidencia);
        for ($i = 0; $i < count($comentarios); $i++) {
            $comentarios[$i]['fecha'] = $comentarios[$i]['comment_date'];
            $comentarios[$i]['hora'] = date('G:i', strtotime($comentarios[$i]['fecha']));
            $comentarios[$i]['dia'] = date('M j', strtotime($comentarios[$i]['fecha']));
            $comentarios[$i]['user'] = Users::obtenerUsuarioPorID($comentarios[$i]['id_user']);

            array_push($data['historial'], $comentarios[$i]);
        }
        $storyState = StoryStates::obtenerHistorialEstadoDeIncidencia($id_incidencia);
        for ($i = 0; $i < count($storyState); $i++) {
            $storyState[$i]['fecha'] = $storyState[$i]['story_date'];
            $storyState[$i]['hora'] = date('G:i', strtotime($storyState[$i]['fecha']));
            $storyState[$i]['dia'] = date('M j', strtotime($storyState[$i]['fecha']));

            array_push($data['historial'], $storyState[$i]);
        }


        // Tras combinar comentarios + Cambios en el estado, se ordena por fecha
        usort($data['historial'], function ($a, $b) {
            return strtotime($a['fecha']) - strtotime($b['fecha']);
        });

        return view('incidences.infoIncidence', ['data' => $data]);
    }



    // Editar

    public function editIncidenceView($id)
    {
        $data['incidencias'] = $this->incidencias->obtenerIncidenciaPorID($id);
        $data['aulas'] = Aulas::all();
        $data['user'] = Users::find($data['incidencias']['id_user']);

        return view('incidences.editIncidence', ['data' => $data]);
    }

    public function updateIncidence(Request $req)
    {
        $data = Incidencias::find($req->id_incidencia);

        // Actualizar StoryState ANTES de realizar los cambios sobre la incidencia
        if ($data->state != $req->state) {
            $storyState = new StoryStates(['id_incidencia' => $data['id_incidencia'], 'state' => $req->state]);
            $storyState->save();
        }

        $data->title = $req->title;
        $data->id_aula = $req->id_aula; 
        $data->description = $req->description;

        // Cada vez que se modifique, la fecha de actualización cambiará.
        // Lo mismo si el estado nuevo es para cerrar.
        $data->update_date = now();
        if($req->state == "closed" && $req->state != $data->state){
            $data->close_date = now();
        }

        $data->state = $req->state;


        // Enviar correo SOLO si se cierra
        if ($req->state == "closed") {
            $id_user = $data->id_user;
            $user = Users::find($id_user);
            Mail::to($user['email'])->send(new NotifyMail("closed", [$data, $user]));
        }

        $data->save();
        $url = "/incidence/info/$req->id_incidencia";
        return redirect($url);
    }

    // Fin Editar

    public function wipIncidence()
    {
        return view('incidences.wip'); // Work In Progress
    }
}
