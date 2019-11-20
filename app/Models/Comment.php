<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
	protected $fillable = ['author_id', 'plan_id', 'parent_id', 'text'];

	public function images()
	{
		return $this->hasMany('App\Models\Image');
	}

	public function user()
	{
		return $this->belongsTo('App\User', 'author_id');
	}

    public static function index($planId)
    {
    	return Comment::with('images')->where('plan_id', $planId)->get();
    }

    public static function store(array $data)
    {
        return Comment::create([
            'author_id' => $data['authorId'],
            'plan_id' => $data['planId'],
            'parent_id' => $data['parentId'],
            'text' => $data['text'],
        ]);
    }

    public static function remove($commentId)
    {
        dump('remove');

        $comment = Comment::find($commentId);

        // dd($comment);

        $comment->delete();
    }
}
