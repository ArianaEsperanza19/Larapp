<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail; # Necesario para la verificacion de email
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

// use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     Register*
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'surname',
        'role',
        'email',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function info($id)
    {
        // $datos = DB::table('users')->where('id', '=', $id)->first();
        $datos = $this::all()->where('id', '=', $id)->first();
        return $datos;
    }

    public function up($info, $id)
    {
        $user = User::find($id);

        // Verificar si se subió una imagen
        if ($info->hasFile('image')) {

            // Generar un nombre único para la imagen
            $img_path = $info->file('image')->getClientOriginalName(); // Ejemplo: "foto.jpg"
            $Justimg_name = pathinfo($img_path, PATHINFO_FILENAME); // Resultado: "foto"
            $extension = $info->file('image')->getClientOriginalExtension();
            $img_path_name = $Justimg_name. "_". time() . '.' . $extension; // Nombre único + extensión original

            // Almacenar en storage/app/public/users
            // $info->file('image')->storeAs('users', $img_path_name, 'public'); // Corregido aquí
            // Sofia@sofia.com 12345678
            // $file = 'users/' . $user->image;
            // if (Storage::disk('public')->exists($file)) {
            //     echo 'La imagen existe.';
            // } else {
            //     echo 'La imagen no existe.';
            //     Storage::disk('public')->put("users/$img_path_name", File::get($info->file('image')));
            // }

            Storage::disk('public')->put("users/$img_path_name", File::get($info->file('image')));

            // Actualizar la ruta en la base de datos
            $user->image = "$img_path_name";
        }

        // Actualizar otros campos
        $user->fill([
            'name' => $info->name,
            'surname' => $info->surname,
            'role' => $info->role,
            'email' => $info->email,
        ]);

        $user->save();
    }
    public function comprobarImg($name, $disk)
    {
        $file = "$disk/" . $name;
        if (Storage::disk('public')->exists($file)) {
            return true;
        } else {
            return false;
        }
    }
    public function avatar($name)
    {
        // Atencion, es necesario requerir Storage y Response
        $file = Storage::disk('public')->get("users/".$name);
        return new Response($file, 200);

    }
    public function getDefaultAvatar()
    {
        $file = Storage::disk('public')->get("default/avatar.webp");
        return new Response($file, 200);
    }
    public function comments()
    {
        # Have many comments
        return $this->hasMany('App\Models\Comment');
    }
}
