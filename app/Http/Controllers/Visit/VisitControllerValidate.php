<?php

namespace App\Http\Controllers\Visit;

use Illuminate\Http\Request;

class VisitControllerValidate
{
    public function ValidateStoreRequest(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:visits,email',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe exceder los 255 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'latitude.required' => 'La latitud es obligatoria.',
            'latitude.numeric' => 'La latitud debe ser un número.',
            'latitude.between' => 'La latitud debe estar entre -90 y 90.',
            'longitude.required' => 'La longitud es obligatoria.',
            'longitude.numeric' => 'La longitud debe ser un número.',
            'longitude.between' => 'La longitud debe estar entre -180 y 180.',
        ]);
    }
}