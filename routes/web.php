<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\StorePersonaRequest;
use App\Models\Persona;



Route::get('/', function () {
    return view('auth.login');
});

Route::get('/personas', function () {
    return view('personas.index');
})->name('personas.index');

Route::get('/personas/create', function () {
    return view('personas.create');
})->name('personas.create');

Route::post('/personas', function (StorePersonaRequest $request) {
    $validated = $request->validated();
    $model = new Persona();
    $model->fill($validated);
    $model->save();
    return redirect()->route('personas.index')->with('info', 'Persona creada exitosamente');
})->name('personas.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
