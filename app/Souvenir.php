<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Souvenir extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'price', 'category', 'prefecture', 'description', 'url', 'address'];

    /**
     * このお土産を所有するユーザ。
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * このお土産が所有する画像
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    
    /**
     * このお土産が所有するレビュー。
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    /**
     * このお土産をお気に入りにしているユーザ
     */
    public function favorite_users()
    {
        return belongsToMany('User::class', 'user_favorite_souvenir', 'souvenir_id', 'user_id')->withTimestamps();
    }
    
    /**
     * このお土産に関係するモデルの件数をロードする。
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount('images');
    }
    
    public function delete()
    {
        $this->performDeleteOnModel();
    }
}
