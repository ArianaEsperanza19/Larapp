<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = [
        'user_id', 'image_id', 'content'
    ];
    public function image()
    {
        return $this->belongsTo('App\Models\Image', 'image_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function up($info)
    {
        $comment = new Comment();
        $comment->fill([
            'user_id' => $info['user'],
            'image_id' => $info['image'],
            'content' => $info['comment']
        ]);
        if ($comment->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function down($id)
    {
        //WARNING: REVISAR SI EL USUARIO ENVIADO POR PARAMETRO ES EL QUE HA CREADO EL COMENTARIO
        $comment = Comment::find($id);

        if ($comment->delete()) {
            return true;
        } else {
            return false;
        }
    }
}
