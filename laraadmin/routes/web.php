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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('member', \App\Http\Controllers\MemberController::class)->except('show');

require __DIR__ . '/auth.php';

Route::post('/', function (\Illuminate\Http\Request $request) {
    $name = $request->input('name');
    $address = $request->input('address');
    $basephone = env('APP_BASEPHONE', '6281907861308');
    return redirect('https://api.whatsapp.com/send?phone={' . $basephone  . '}&text=' . '!daftar@' . $name . '@' . $address);
})->name('/');
