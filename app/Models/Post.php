<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];


    public function _content()
    {
        return $this->hasMany(PostContent::class,'post_id','id');
    }

    public function _content_lang()
    {
        return $this->hasOne(PostContent::class,'post_id','id')->where('language','=',app()->getLocale());
    }
}
