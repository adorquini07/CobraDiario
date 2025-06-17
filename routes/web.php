<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\StorePersonaRequest;
use App\Models\Persona;



// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/personas', function () {
    $personas = Persona::all();
    return view('personas.index', compact('personas'));
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

Route::delete('/personas/{id}', function (int $id) {
    $persona = Persona::findOrFail($id);
    $persona->delete();
    return redirect()->route('personas.index')->with('info', 'Persona eliminada exitosamente');
})->name('personas.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
