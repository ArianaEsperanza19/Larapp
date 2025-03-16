<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function config()
    {
        // conseguir id del usuario identificado
        $sesion = Auth::user();
        $user = new User();
        $info = $user->info($sesion->id);
        return view('user.config', array('user' => $info));
    }

    public function update(Request $request)
    {
        $sesion = Auth::user();
        # Validaciones
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $sesion->id . '|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user = new User();
        $user->up($request, $sesion->id);
        return redirect()->route('dashboard')->with('message', "Información actualizada correctamente");
    }
    public function getImage($fileName)
    {
        $user = new User();
        $file = $user->avatar($fileName);
        return $file;

    }
    public function getDefaultAvatar()
    {
        $user = new User();
        $file = $user->getDefaultAvatar();
        return $file;
    }
}
