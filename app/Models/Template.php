<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class Template extends Model
{
    use HasFactory;


     protected $fillable = [
'cat_id',
'name',
'slug',
'img',
'file',
'is_pro',


];
public function category()
    {
        return $this->belongsTo(Category::class,'cat_id','id');
    }
protected $table="templates";
}
