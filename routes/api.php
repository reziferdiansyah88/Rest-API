<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MembersController;

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

// GET ALL MEMEBERS
Route::get('members/list', [MembersController::class, 'membersList']);

// CRETE MEMBERS
Route::post('members/create', [MembersController::class, 'membersCreate']);

// DETAIL MEMBERS
Route::get('members/detail/{id}', [MembersController::class, 'membersDetail']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
