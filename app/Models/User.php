<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail; # Necesario para la verificacion de email
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $user->fill([
            'name' => "$info->name",
            'surname' => "$info->surname",
            'role' => "$info->role",
            'email' => "$info->email"
        ]);
        $user->save();

    }

    public function comments()
    {
        # Have many comments
        return $this->hasMany('App\Models\Comment');
    }
}
