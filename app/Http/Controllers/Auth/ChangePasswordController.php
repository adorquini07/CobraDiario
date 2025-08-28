<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class ChangePasswordController extends Controller
{
    /**
     * Display the change password form.
     */
    public function show()
    {
        return view('auth.change-password');
    }

    /**
     * Handle the password change request.
     */
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.required' => 'La contraseña actual es requerida.',
            'password.required' => 'La nueva contraseña es requerida.',
            'password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
        ]);

        $user = Auth::user();

        // Verificar que la contraseña actual sea correcta
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'La contraseña actual es incorrecta.'
            ]);
        }

        // Verificar que la nueva contraseña sea diferente a la actual
        if (Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'La nueva contraseña debe ser diferente a la actual.'
            ]);
        }

        // Actualizar la contraseña usando el modelo directamente
        \App\Models\User::where('id', $user->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('password.change')->with('status', 'Contraseña actualizada exitosamente.');
    }
}
