<?php

use Illuminate\Support\Facades\Auth;
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






Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login');

Route::middleware(['auth:admin'])
  ->group(function ($route) {


    $route->get('/', function () {
      return redirect()->route('admin.customers.index');
    })->name('dashboard');

    $route->post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    $route->get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'view'])->name('profile');
    $route->put('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    
    $route->get('/customers', [App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customers.index');
    $route->post('/customers', [App\Http\Controllers\Admin\CustomerController::class, 'store'])->name('customers.store');

    $route->get('/customers/create', [App\Http\Controllers\Admin\CustomerController::class, 'create'])->name('customers.create');
    $route->get('/customers/export', [App\Http\Controllers\Admin\CustomerController::class, 'export'])->name('customers.export');
    $route->get('/customers/{customer}', [App\Http\Controllers\Admin\CustomerController::class, 'edit'])->name('customers.edit');
    $route->put('/customers/{customer}', [App\Http\Controllers\Admin\CustomerController::class, 'update'])->name('customers.update');
    $route->delete('/customers/{customer}', [App\Http\Controllers\Admin\CustomerController::class, 'destroy'])->name('customers.destroy');
    $route->get('/customers/{customer}/detail', [App\Http\Controllers\Admin\CustomerController::class, 'detail'])->name('customers.detail');
    $route->put('/customers/{customer}/note', [App\Http\Controllers\Admin\CustomerController::class, 'note'])->name('customers.note');


    $route->get('/applications', [App\Http\Controllers\Admin\ApplicationController::class, 'index'])->name('applications.index');
    $route->get('/applications/create', [App\Http\Controllers\Admin\ApplicationController::class, 'create'])->name('applications.create');
    $route->get('/applications/export', [App\Http\Controllers\Admin\ApplicationController::class, 'export'])->name('applications.export');

    $route->put('/applications/update_status', [App\Http\Controllers\Admin\ApplicationController::class, 'update_status'])->name('applications.update_status');

    $route->get('/applications/{application}/pdf', [App\Http\Controllers\Admin\ApplicationController::class, 'pdf'])->name('applications.pdf');
    $route->get('/applications/{application}/pdf_print', [App\Http\Controllers\Admin\ApplicationController::class, 'pdfPrint'])->name('applications.pdf_print');
    $route->post('/applications/{application}/contract', [App\Http\Controllers\Admin\ApplicationController::class, 'updateContract'])->name('applications.contract');
    $route->post('/applications/{application}/printer', [App\Http\Controllers\Admin\ApplicationController::class, 'printer'])->name('applications.printer');
    $route->get('/applications/{application}', [App\Http\Controllers\Admin\ApplicationController::class, 'edit'])->name('applications.edit');
    $route->put('/applications/{application}', [App\Http\Controllers\Admin\ApplicationController::class, 'update'])->name('applications.update');
    $route->delete('/applications/{application}', [App\Http\Controllers\Admin\ApplicationController::class, 'destroy'])->name('applications.destroy');
    $route->get('/applications/{customerId}/member', [App\Http\Controllers\Admin\ApplicationController::class, 'byUserId'])->name('applications.byUserId');

    $route->get('/master_ads', [App\Http\Controllers\Admin\MasterAdController::class, 'index'])->name('master_ads.index');
    $route->post('/master_ads', [App\Http\Controllers\Admin\MasterAdController::class, 'store'])->name('master_ads.store');
    $route->get('/master_ads/create', [App\Http\Controllers\Admin\MasterAdController::class, 'create'])->name('master_ads.create');
    $route->get('/master_ads/export', [App\Http\Controllers\Admin\MasterAdController::class, 'export'])->name('master_ads.export');
    $route->get('/master_ads/print', [App\Http\Controllers\Admin\MasterAdController::class, 'print'])->name('master_ads.print');
    $route->get('/master_ads/{masterAd}', [App\Http\Controllers\Admin\MasterAdController::class, 'edit'])->name('master_ads.edit');
    $route->put('/master_ads/{masterAd}', [App\Http\Controllers\Admin\MasterAdController::class, 'update'])->name('master_ads.update');
    $route->delete('/master_ads/{masterAd}', [App\Http\Controllers\Admin\MasterAdController::class, 'destroy'])->name('master_ads.destroy');
  });
