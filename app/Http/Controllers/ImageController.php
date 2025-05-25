<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    // Formulario
    public function imgForm()
    {
        return view('image.form');
    }
    // Subir una imagen
    public function upload(Request $request)
    {
        $sesion = Auth::user();
        # Validaciones
        $validate = $request->validate([
            'descripcion' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|required',
        ]);
        $img = new Image();
        $img = $img->up($request, $sesion->id);
        if ($img) {
            return redirect()->route('dashboard')->with('message', 'Imagen subida correctamente');
        } else {
            return redirect()->route('img.form')->with('error', 'Error al subir la imagen');
        }
    }

    // Mostrar todas las imagenes
    public function show_all()
    {
        $images = new Image();
        $data = $images->getAll();
        return view('image.posts', ['images' => $data]);
    }
    // Mostrar las imagenes de un usuario
    public function show_id($id)
    {
        $images = new Image();
        $data = $images->getImgs($id);
        return view('', ['images' => $data]);
    }

    // Mostrar detalles de una imagen
    public function show_details($id_img)
    {
        $image = Image::find($id_img);
        $comments = Image::find($id_img)->comments()->get();
        return view('image.details', array('image' => $image, 'comments' => $comments));
    }


}
