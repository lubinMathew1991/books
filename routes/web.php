<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;

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
    return redirect()->route('books.index');
});



Route::get('books/import', [BooksController::class, 'import'])->name('books.import');
Route::post('books/import-save', [BooksController::class, 'importSave'])->name('books.importSave');

Route::resource('books', BooksController::class);

