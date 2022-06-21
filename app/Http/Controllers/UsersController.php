<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Users;

class UsersController extends Controller
{
    protected $incidencias;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function index()
    {
        $users = $this->users->obtenerUsuarios();
        return view('users.listUsers', ['users' => $users]);
    }

    public function datosUser($id)
    {
        $user = $this->users->obtenerUsuarioPorID($id);
        return view('users.datosUser', ['user' => $user]);
    }

    public function infoUser($id)
    {
        $user = $this->users->obtenerUsuarioPorID($id);
        return view('users.infoUser', ['user' => $user]);
    }

    public function editUserView($id)
    {
        $user = $this->users->obtenerUsuarioPorID($id);
        return view('users.editUser', ['user' => $user]);
    }

    public function update(Request $req){
        $data = Users::find($req->id);
        $data->first_name=$req->first_name;
        $data->last_name=$req->last_name;
        $data->email=$req->email;

        $data->validated=$req->validated;
        $data->rol=$req->rol;
        $data->gender=$req->gender;

        $data->dni=$req->dni;
        $data->tel=$req->tel;
        $data->notify_email=$req->notify_email;
        $data->save();

        $url="/users";
        return redirect($url);
    }

    public function editDataView($id)
    {
        $user = $this->users->obtenerUsuarioPorID($id);
        return view('users.editDataUser', ['user' => $user]);
    }

    public function updateData(Request $req){
        $data = Users::find($req->id);
        $data->first_name=$req->first_name;
        $data->last_name=$req->last_name;
        $data->email=$req->email;
        $data->tel=$req->tel;

        $data->dni=$req->dni;
        $data->gender=$req->gender;
        $data->notify_email=$req->notify_email;
        

        $data->save();
        $url="/datos/$req->id";
        return redirect($url);
    }

    public function wip()
    {
        return view('users.wip');
    }
}
