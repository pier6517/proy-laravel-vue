<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'category_id',
        'description',
        'author_id',
        'state'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id','id');

    }
    public function author()
    {
        return $this->belongsTo(User::class,'author_id');
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    
}
