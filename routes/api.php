<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MembersController;
use App\Http\Controllers\API\MahasiswaController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\AuthController;

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


/**
 * SIMPLE CRUD MEMBERS
*/

// GET ALL MEMEBERS
Route::get('members/list', [MembersController::class, 'membersList']);

// CRETE MEMBERS
Route::post('members/create', [MembersController::class, 'membersCreate']);

// DETAIL MEMBERS
Route::get('members/detail/{id}', [MembersController::class, 'membersDetail']);

// UPDATE MEMBERS 
Route::post('members/update/{id}', [MembersController::class, 'membersUpdate']);

// DELETE MEMBERS
Route::post('members/delete/{id}', [MembersController::class, 'membersDelete']);


/**
 * CRUD MAHASISWA VALIDATION
 * ADD PAGINATION AND SEARCH IN LIST MAHASISWA
 * 
*/

// GET ALL MAHASISWA
Route::get('mahasiswa/list', [MahasiswaController::class, 'mahasiswaList']);

// CREATE MAHASISWA
Route::post('mahasiswa/create', [MahasiswaController::class, 'mahasiswaCreate']);

// DETAIL MAHASISWA
Route::get('mahasiswa/detail/{id}', [MahasiswaController::class, 'mahasiswaDetail']);

// UPDATE MAHASISWA
Route::post('mahasiswa/update/{id}', [MahasiswaController::class, 'mahasiswaUpdate']);

// DELETE MAHASISWA
Route::post('mahasiswa/delete/{id}', [MahasiswaController::class, 'mahasiswaDelete']);


/**
 * REGISTER
 * LOGIN 
 * LOGOUT
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
