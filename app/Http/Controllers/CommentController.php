<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function register(Request $request)
    {
        # monstrar nombre
        $datos = $request->validate(
            [   'user' => 'required|integer',
                'image' => 'required|integer',
                'comment' => 'required|string|max:255|min:10' ]
        );

        $comment = new Comment();
        $comment->up($request);
        return redirect()->back();

    }

    public function delete($id)
    {
        $comment = new Comment();
        $comment->down($id);
        return redirect()->back();
    }
}
