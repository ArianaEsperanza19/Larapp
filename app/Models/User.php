<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail; # Necesario para la verificacion de email
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Container\Attributes\Storage;
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

            var_dump($img_path_name);
            // Almacenar en storage/app/public/users
            $info->file('image')->storeAs('users', $img_path_name, 'public'); // Corregido aquí


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
    public function comments()
    {
        # Have many comments
        return $this->hasMany('App\Models\Comment');
    }
}
