<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Incidencias;
use App\Models\Users;

Route::get('/', function () {
    $data['incidencias_abiertas'] = Incidencias::where('state', 'new')->count() + Incidencias::where('state', 'open')->count();
    $data['incidencias'] = Incidencias::count();
    $data['users'] = Users::count();
    return view('welcome', ['data' => $data]);
});

require __DIR__.'/auth.php';

// Incidencias

    use App\Http\Controllers\IncidenceController;

    Route::get('/incidences', [IncidenceController::class, 'index'])->middleware(['auth']);

    Route::get('/incidences/open/user/{id_user}', [IncidenceController::class, 'openIncidences'])->middleware(['auth']);

    Route::get('/user/incidences/history/{id_user}', [IncidenceController::class, 'userIncidenceHistory'])->middleware(['auth']);

    // CRUD Operations
    Route::get('/incidence/info/{id_incidencia}', [IncidenceController::class, 'infoIncidence'])->middleware(['auth']);

    Route::get('/incidence/new', [IncidenceController::class, 'newIncidence'])->middleware(['auth']);
    Route::post('/incidence/new', [IncidenceController::class, 'storeIncidence'])->middleware(['auth']);

    Route::get('/incidence/edit/{id_incidencia}', [IncidenceController::class, 'editIncidenceView'])->middleware(['auth']);
    Route::post('/incidence/edit/{id_incidencia}', [IncidenceController::class, 'updateIncidence'])->middleware(['auth']);

    Route::get('/incidence/delete/{id_incidencia}', [IncidenceController::class, 'wipIncidence'])->middleware(['auth']);

// Usuarios

    use App\Http\Controllers\UsersController;

    Route::get('/users', [UsersController::class, 'index'])->middleware(['auth']);

    Route::get('/datos/{id}', [UsersController::class, 'datosUser'])->middleware(['auth']);

    // Editar

        Route::get('/datos/edit/{id_user}', [UsersController::class, 'editDataView'])->middleware(['auth']);
        Route::post('/datos/edit/{id_user}', [UsersController::class, 'updateData'])->middleware(['auth']);

    // Fin Editar


    // CRUD Operations
    Route::get('/user/info/{id}', [UsersController::class, 'infoUser'])->middleware(['auth']);

    Route::get('/user/edit/{id_user}', [UsersController::class, 'editUserView'])->middleware(['auth']);
    Route::post('/user/edit/{id_user}', [UsersController::class, 'update'])->middleware(['auth']);

    Route::get('/user/delete/{id_user}', [UsersController::class, 'wip'])->middleware(['auth']);

// Aulas

    use App\Http\Controllers\AulasController;

    Route::get('/aulas', [AulasController::class, 'index'])->middleware(['auth']);

    Route::get('/aula/new', [AulasController::class, 'newAula'])->middleware(['auth']);
    Route::post('/aula/new', [AulasController::class, 'storeAula'])->middleware(['auth']);

    // Editar

    Route::get('/aula/edit/{id_user}', [AulasController::class, 'editAulaView'])->middleware(['auth']);
    Route::post('/aula/edit/{id_user}', [AulasController::class, 'updateData'])->middleware(['auth']);

    // Fin Editar

// Pruebas

    Route::view('/test', 'emails.commentMail'); // Comentario
    Route::view('/testt', 'emails.commentMaill'); // Comentario

// Comentario 

    use App\Http\Controllers\CommentsController;
    Route::post('/incidence/info/{id_incidencia}', [CommentsController::class, 'storeComment'])->middleware(['auth']);
