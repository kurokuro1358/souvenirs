<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;
    protected $fillable = ['path'];
    
    /**
    * お土産が所有する画像
    */
    public function souvenir()
    {
        return $this->belongsTo(Souvenir::class);
    }
    
    public function delete()
    {
        $this->performDeleteOnModel();
    }
}
