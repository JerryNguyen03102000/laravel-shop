<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table = 'brands';
    use HasFactory;
    protected $fillable=[
        'id','title','slug','image','description','status'
    ];
    protected $primaryKey = 'id';
    public $timestamps = false;
}
