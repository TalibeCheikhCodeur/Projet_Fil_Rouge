<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CoursGlobalClasseController;
use App\Http\Controllers\CoursGlobalController;
use App\Http\Controllers\EtidiantController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\SemestreController;
use App\Http\Controllers\SessionCourController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register',[AuthController::class,'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);
Route::apiResource('modules', ModuleController::class);
Route::apiResource('profs', ProfesseurController::class);
Route::apiResource('semestres', SemestreController::class);
Route::apiResource('cours', CoursGlobalController::class);
Route::apiResource('classes',ClasseController::class);
Route::apiResource('inscris',EtidiantController::class);
Route::apiResource('sessions',SessionCourController::class);
Route::post('getClasse',[SessionCourController::class,'getCoursClasse']);
Route::apiResource('salles',SalleController::class);
Route::apiResource('coursClasses',CoursGlobalClasseController::class);
// Route::post('',[CoursGlobalController::class,'isInserable']);
