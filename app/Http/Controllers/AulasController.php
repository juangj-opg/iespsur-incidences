<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Aulas;

class AulasController extends Controller
{
    protected $aulas;

    public function __construct(Aulas $aulas)
    {
        $this->aulas = $aulas;
    }

    public function index()
    {
        $aulas = $this->aulas->obtenerAulas();
        return view('aulas.listAulas', ['aulas' => $aulas]);
    }

    // Nueva Aula
    public function newAula()
    {
        $aulas = $this->aulas->obtenerAulas();
        return view('aulas.newAula', ['aulas' => $aulas]);
    }

    public function storeAula(Request $request)
    { 
        $aula = new Aulas($request->all());
        $aula->save();
        return redirect('/aulas');     
    }

    // Fin nueva Aula

    
    // Editar Aula
    public function editAulaView($id)
    {
        $aula = $this->aulas->obtenerAulaPorID($id);
        return view('aulas.editAula', ['aula' => $aula]);
    }

    public function updateData(Request $req){
        $data = Aulas::find($req->id);
        $data->aula=$req->aula;

        $data->save();
        $url="/aulas";
        return redirect($url);
    }

    // Fin editar aula
}
