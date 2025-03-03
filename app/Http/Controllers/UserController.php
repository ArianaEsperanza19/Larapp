<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function config(Request $request)
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
        $user = new User();
        $user->up($request, $sesion->id);
        return view('dashboard');
    }
}
