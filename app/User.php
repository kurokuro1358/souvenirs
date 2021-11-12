<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
    
    /**
     * このユーザが所有するお土産。
     */
    public function souvenirs()
    {
        return $this->hasMany(Souvenir::class);
    }
    
    /**
     * このユーザが所有するレビュー。
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    /**
    * このユーザがお気に入りにしているお土産
    */
    public function favorites()
    {
        return $this->belongsToMany(Souvenir::class, 'user_favorite_souvenir', 'user_id', 'souvenir_id')->withTimestamps();
    }
    
     /**
     * $souvenirIdで指定されたお土産をお気に入りにする。
     *
     * @param  int  $souvenirId
     * @return bool
     */
    public function favorite($souvenirId)
    {
        // すでにお気に入りにしているかの確認
        $exist = $this->is_favorite($souvenirId);

        if ($exist) {
            // すでにお気に入りにしていれば何もしない
            return false;
        } else {
            // お気に入りにしていなければお気に入りにする
            $this->favorites()->attach($souvenirId);
            return true;
        }
    }
    
    /**
     * $souvenirIdで指定されたユーザをアンフォローする。
     *
     * @param  int  $souvenirId
     * @return bool
     */
    public function unfavorite($souvenirId)
    {
        // すでにお気に入りにしているかの確認
        $exist = $this->is_favorite($souvenirId);

        if ($exist) {
            // すでにお気に入りにしていればお気に入りを外す
            $this->favorites()->detach($souvenirId);
            return true;
        } else {
            // お気に入りにしていれば何もしない
            return false;
        }
    }
    
    /**
     * 指定された $souvenirIdのお土産をこのユーザが理おきにい中であるか調べる。お気に入り中ならtrueを返す。
     *
     * @param  int  $souvenirId
     * @return bool
     */
    public function is_favorite($souvenirId)
    {
        // フォロー中ユーザの中に $userIdのものが存在するか
        return $this->favorites()->where('souvenir_id', $souvenirId)->exists();
    }
    
    /**
     * このユーザに関係するモデルの件数をロードする。
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount('souvenirs', 'favorites');
    }
}
