<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function like($id)
    {
        // Recoger datos del usuario y la imagen
        $user = Auth::user()->id;
        $image = Image::find($id)->id;
        /* echo "<pre>"; */
        /* print_r($image); */
        /* echo "</pre>"; */
        /* echo "<pre>"; */
        /* print_r($user); */
        /* echo "</pre>"; */

        // Comprobar si ya existe el like
        $like = new Like();
        if (!Like::where('user_id', $user)->where('image_id', $image)->count()) {
            if ($like->up($user, $image)) {
                return redirect()->route('img.details', ['id_img' => $id]);
            } else {
                echo "ERROR al subir el like";
            }

        } else {
            if ($like->down($user, $image)) {
                return redirect()->route('img.details', ['id_img' => $id]);
            } else {
                echo "ERROR al borrar el like";
            }
        }

    }

    public function unlike($id)
    {

    }
}
