<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','title','slug','image','description','status'
    ];
    protected $primaryKey = 'id';
    protected $table = 'category';
   public $timestamps = false;
}
