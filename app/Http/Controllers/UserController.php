<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;

class UserController extends Controller
{
    // Indice de usuarios
    public function index($search = null)
    {
        if ($search != null) {
            $users = new User();
            $data = $users->search($search);
            return view('user.index', ['users' => $data]);
        } else {
            $users = new User();
            $data = $users->users();
            return view('user.index', ['users' => $data]);
        }

    }
    // Ir al dashboard para ver info basica y tus post
    public function dashboard()
    {
        $user = Auth::user();
        $images = new Image();
        $data = $images->getImgs($user->id);
        return view('dashboard', ['images' => $data]);
    }

    // Ver info de un usuario
    public function info($id)
    {
        $user = new User();
        $info = $user->info($id);
        $user = $info['user'];
        $images = $info['images'];
        return view('user.info', compact('user', 'images'));

    }

    // Ir a la configuracion de un usuario
    public function config()
    {
        $sesion = Auth::user();
        $user = new User();
        $info = $user->info($sesion->id);
        // Convertir en objeto
        return view('user.config', array('user' => $info['user']));
    }
    // Actualizar la informacion de un usuario
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
    // Devuelve la imagen de un usuario
    public function getAvatar($fileName)
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


    /* public function show_img_id() */
    /* { */
    /*     $user = Auth::user(); */
    /*     $images = new Image(); */
    /*     $data = $images->getImgs($user->id); */
    /*     return view('dashboard', ['images' => $data]); */
    /* } */
}
