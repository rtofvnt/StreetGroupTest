<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CsvController;

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

Route::post('/upload_and_pricess_csv', [CsvController::class, 'uploadAndProcess'])->name('uploadAndProcess');

Route::get('/', [CsvController::class, 'index'])->name('index');

