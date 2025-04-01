<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShoppingListItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('shoppingListItem', ShoppingListItemController::class);
    Route::get('shoppingListitem/import', [ShoppingListItemController::class,'showImport'])->name('shoppingListItem.showImport');
    Route::post('shoppingListitem/import', [ShoppingListItemController::class,'import'])->name('shoppingListItem.import');
    Route::get('shoppingListitem/export', [ShoppingListItemController::class,'export'])->name('shoppingListItem.export');
});

require __DIR__.'/auth.php';
