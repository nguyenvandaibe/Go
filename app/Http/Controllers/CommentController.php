<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\ReplyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function getComments($planId)
    {
        return Comment::with('images', 'user')->where('plan_id', $planId)->get();
    }

    public function create(Request $request, $planId)
    {

        $data = [
            'authorId' => Auth::id(),
            'planId' => $planId,
            'parentId' => null,
            'text' => $request->all()['new-comment-text']
        ];

        // dd($request->images);

        $images = $request->images;

        $newComment = Comment::store($data);

        $commentId = $newComment->id;

        if ($images != null) {

            Image::store($images, $commentId);
        }
    }


    public function reply(Request $request, $planId, $commentId)
    {
        $data = [
            'authorId' => Auth::id(),
            'planId' => $planId,
            'parentId' => $commentId,
            'text' => $request->all()['reply-text-' . $commentId . ''],
        ];

        Comment::store($data);
    }

    public function delete(Request $request)
    {
        $commentId = $request->all()['commentId'];

        Image::remove($commentId);

        Comment::remove($commentId);
    }
}
