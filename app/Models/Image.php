<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['comment_id', 'path'];

    public static function store(array $images, $commentId)
    {
        foreach ($images as $i => $image) {

            $name = 'comment_' .  $commentId . '_image_' . $i . '.' . $image->getClientOriginalExtension();

            $image->move(public_path() . '/images/comments/', $name);

            Image::create([
                'comment_id' => $commentId,
                'path' => '/images/comments/' . $name,
            ]);
        }
    }

    public static function remove($commentId)
    {
        $images = Image::where('comment_id', $commentId)->get();

        if (count($images) > 0) {
            
            foreach ($images as $image) {
                $image->delete();
            }
        }
    }
}