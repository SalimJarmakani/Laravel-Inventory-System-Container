<?php

use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;
use App\Models\Inventory;

Route::get('/', function () {
    $inventories = Inventory::all();
    return view('index', compact('inventories'));
});

Route::resource('inventory', InventoryController::class);


// Route::middleware(['auth'])->group(function () {
//     Route::resource('inventory', InventoryController::class);
// });
