<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    protected $fillable = [
        'name',
        'post',
        'start_date',
        'end_date',
        'news_date',
        'is_visible',
        'image',
        'category_id',
    ];


    public function category(){
        return $this->belongsTo(Category::class);
    }

    use HasFactory;
}
