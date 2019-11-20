<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'full_name', 'gender', 'date_of_birth', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function plans()
    {
        return $this->hasMany('App\Models\Plan');
    }

    public function storeUpdate(User $user, array $data, string $pathAvatar)
    {
        $data = [
            'full_name' => $data['full_name'],
            'gender' => $data['gender'],
            'date_of_birth' => $data['date_of_birth'],
            'path_avatar' => $pathAvatar,
        ];
        $user->update($data);
        $user->save();
    } 
}
