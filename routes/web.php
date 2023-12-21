<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Models\Category;
use App\Models\Employee;
use App\Models\User;
use Database\Factories\SalesFactory;
use Illuminate\Foundation\Bootstrap\RegisterFacades;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use function Psy\Test\Command\ListCommand\Fixtures\foo;

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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/register', [RegisterController::class, 'register'])->name('register');
//   Route::post('/register', [RegisterController::class, 'registerPost'])->name('register');
//   Route::get('/login', [LoginController::class, 'login'])->name('login');
//   Route::post('/login', [LoginController  ::class, 'loginPost'])->name('login');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('categories', CategoryController::class, );
Route::resource('menu', FoodController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('payments', PaymentController::class);
Route::resource('sales', SaleController::class);
Route::resource('reports', ReportController::class);
Route::post('menu/edit/{id}',[FoodController::class, 'update']);


 
Route::post('menu.create', [CategoryController::class, 'create'] );
Route::post('/reports/generate',[ ReportController::class, 'generate'])->name("reports.generate");

});
