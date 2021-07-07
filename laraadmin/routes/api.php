<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('member', function (Request $request) {
    $memberCek = App\Models\Member::where('phone', $request->input('phone'))->first();
    // null berarti belum terdaftar
    if ($memberCek === null) {
        App\Models\Member::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);
        return response([
            // berhasil terdaftar
            'status' => 'success',
            'messages' => $request->input('name')
        ]);
    } else {
        return response([
            // sudah terdaftar
            'status' => 'error',
            'name' => $memberCek->name,
            'phone' => $memberCek->phone,
            'address' => $memberCek->address
        ]);
    }
});
