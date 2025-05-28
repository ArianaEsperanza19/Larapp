<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Image extends Model
{
    # The table associated with the model.
    protected $table = 'images';
    protected $fillable = ['user_id', 'image_path', 'description'];
    # The attributes that are mass assignable.
    public function comments()
    {
        # Have many comments
        return $this->hasMany('App\Models\Comment')->orderBy('created_at', 'desc');
    }
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getAll()
    {
        // $images = Image::Paginate(2);
        $images = Image::orderBy('created_at', 'desc')->paginate(2);

        return $images;

    }

    public function getImgs($id)
    {
        $images = Image::where('user_id', '=', $id)
               ->orderBy('created_at', 'desc')
               ->paginate(2);

        // $images = Image::where('user_id', $id)->get();
        return $images;
    }
    public function miniatura($name)
    {
        $file = Storage::disk('public')->get("image/$name");
        return new Response($file, 200);
    }

    public function up(Request $request, $id)
    {
        $datos = $request->all();
        if ($request->hasFile('image')) {

            // Generar un nombre único para la imagen
            $img_path = $request->file('image')->getClientOriginalName(); // Ejemplo: "foto.jpg"
            $Justimg_name = pathinfo($img_path, PATHINFO_FILENAME); // Resultado: "foto"
            $extension = $request->file('image')->getClientOriginalExtension();
            $img_path_name = $Justimg_name. "_". time() . '.' . $extension; // Nombre único + extensión original
            Storage::disk('public')->put("image/$img_path_name", File::get($request->file('image')));
        }
        $img = new Image();
        $img->fill([
            'user_id' => $id,
            'image_path' => $img_path_name,
            'description' => $datos['descripcion']
        ])->save();
        return $img;

    }

    public function edit(Request $request)
    {
        $image_path = $request->file('image');
        $datos = Image::find($request->id_img);
        $datos->description = $request->descripcion;

        if ($image_path) {
            // Borrar imagen anterior
            Storage::disk('public')->delete("image/$datos->image_path");
            // Generar un nombre único para la imagen
            $img_path = $request->file('image')->getClientOriginalName(); // Ejemplo: "foto.jpg"
            $Justimg_name = pathinfo($img_path, PATHINFO_FILENAME); // Resultado: "foto"
            $extension = $request->file('image')->getClientOriginalExtension();
            $img_path_name = $Justimg_name. "_". time() . '.' . $extension; // Nombre único + extensión original
            Storage::disk('public')->put("image/$img_path_name", File::get($request->file('image')));

        }
        // Cambiar nombre
        $datos->image_path = $img_path_name;
        // Actualizar
        $datos->update();
        return redirect()->route('dashboard')->with('message', 'Imagen editada correctamente');

    }

    public function down($img_path_name)
    {

        Storage::disk('public')->delete("image/$img_path_name");
    }
}
