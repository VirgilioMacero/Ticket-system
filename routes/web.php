<?php

use App\Http\Controllers\AreaServiceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Models\Ticket;
use Illuminate\Support\Facades\Route;
use App\Mail\Notification;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

/* Company Routes */

Route::middleware('auth')->resource('company',CompanyController::class);
Route::get('/company/{id}/services/',[CompanyController::class,'showContractedServices'])->middleware('auth')->name('company.showContractedServices');
Route::delete('/company/{CompanyId}/services/{ServiceId}',[CompanyController::class,'destroyContractedService'])->middleware('auth')->name('company.destroyContractedService');

/* Employee Routes */

Route::middleware('auth')->resource('employee',EmployeeController::class);
Route::get('/employees/{id}', [EmployeeController::class,'indexCompany'])->middleware('auth')->name('employee.indexCompany');

/* Area Service Routes */

Route::middleware('auth')->resource('area_service',AreaServiceController::class);

/* Ticket Routes */

Route::middleware('auth')->resource('ticket',TicketController::class);
Route::put('/ticket/updateToInProgress/{id}',[TicketController::class,'updateStateInProgress'])->middleware('auth')->name('ticket.updateToInProgress');
Route::put('/ticket/updateToOpen/{id}',[TicketController::class,'updateStateOpen'])->middleware('auth')->name('ticket.updateToOpen');

/* Service Routes */

Route::middleware('auth')->resource('service',ServiceController::class);
Route::get('/services/{id}',[ServiceController::class,'indexServices'])->middleware('auth')->name('service.indexServices');
Route::get('/service/{idService}/move',[ServiceController::class,'move'])->middleware('auth')->name('service.move');



/* Statistics Routes*/

Route::get('/statistics',[StatisticsController::class,'index'])->middleware('auth')->name('statistics.index');

/* User Routes */

Route::middleware('auth')->resource('user', UserController::class);

/*Mail Routes*/

//  Route::get('/mail',function(){

//     // $response = Mail::to('virgiliomacero9@gmail.com')->send(new Notification('Nuevo Ticket Hola'));

//     //  dump($response);

//      return view('mails.areaMail');

// })->middleware('auth')->name('mail.send');
