<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $fillable = [
        'image_id', 'user_id'
    ];
    public function image()
    {
        return $this->belongsTo('App\Models\Image', 'image_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    // Me gusta
    public function up($user, $image)
    {
        $like = new Like();
        $like->fill([
            'user_id' => $user,
            'image_id' => $image
        ]);
        if ($like->save()) {
            return true;
        } else {
            return false;
        }


    }

    // No me gusta
    public function down($user, $image)
    {
        $like = Like::where('user_id', $user)->where('image_id', $image)->first();
        if ($like->delete()) {
            return true;
        } else {
            return false;
        }
    }
}
