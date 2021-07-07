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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/member', function () {
    return view('member.index');
})->name('member');

Route::post('/member', function (\Illuminate\Http\Request $request) {
    $name = $request->input('name');
    $address = $request->input('address');
    $basephone = env('APP_BASEPHONE', '6285649439890');
    return redirect('https://api.whatsapp.com/send?phone={' . $basephone  . '}&text=' . '!daftar@' . $name . '@' . $address);
})->name('member');
