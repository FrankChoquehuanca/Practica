<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Models\Persona;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $personas = Persona::all();
        return view('auth.register', compact('personas'));
    }

    public function register(Request $request, CreateNewUser $creator)
    {
        $creator->create($request->all());

        return redirect('/dashboard'); // O la ruta que desees después del registro
    }
}
