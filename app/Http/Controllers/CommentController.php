<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{

    protected $redirect = '/';

    public function create(Request $request)
    {
        $rules = [
            'comment' => ['required'],
            'rating' => ['required', 'in:1,2,3,4,5']
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()
                ->to(url()->previous())
                ->withFragment('#add-comment')
                ->withErrors($validator)
                ->withInput();
        }

        $content = $request->input('comment');
        $rating = $request->input('rating');
        $user = Session::get('user');
        $recipe = Session::get('recipe');

        $comment = new Comment();
        $comment->content = $content;
        $comment->rating = $rating;
        $comment->user()->associate($user);
        $comment->recipe()->associate($recipe);

        $comment->save();

        return redirect()->back()->with('success', 'Votre commentaire a bien été enregistré');

    }
}
