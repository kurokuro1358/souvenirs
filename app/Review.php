<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id', 'user_email', 'souvenir_id', 'comment'];
    
    /**
     * このレビューを所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * このレビューを所有するお土産。（ Souvenirモデルとの関係を定義）
     */
    public function souvenir()
    {
        return $this->belongsTo(Souvenir::class);
    }
}
