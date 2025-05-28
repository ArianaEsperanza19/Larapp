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

    // Relaciones
    public function images()
    {
        return $this->hasMany(Image::class, 'user_id');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
    // Informacion de un usuario
    public function info($id)
    {
        //BUG: No se pagina correctamente el contenido
        $user = User::findOrFail($id); // Obtiene solo un usuario
        $images = Image::where('user_id', $id)->paginate(2); // Solo sus imágenes paginadas
        return compact('user', 'images');
    }

    // Actualizar informacion
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
            Storage::disk('public')->put("users/$img_path_name", File::get($info->file('image')));

            // Actualizar la ruta en la base de datos
            $user->image = "$img_path_name";
        }

        // Actualizar otros campos
        $user->fill([
            'name' => $info->name,
            'surname' => $info->surname,
            'role' => $info->role ?? "user",
            'email' => $info->email,
        ]);

        $user->save();
    }
    // Comprobar si una imagen existe
    public function comprobarImg($name, $disk)
    {
        $file = "$disk/" . $name;
        if (Storage::disk('public')->exists($file)) {
            return true;
        } else {
            return false;
        }
    }
    // Obtener la imagen de un usuario
    public function avatar($name)
    {
        // Atencion, es necesario requerir Storage y Response
        $file = Storage::disk('public')->get("users/".$name);
        return new Response($file, 200);

    }

    // Obtener la imagen por defecto
    public function getDefaultAvatar()
    {
        $file = Storage::disk('public')->get("default/avatar.webp");
        return new Response($file, 200);
    }
}
