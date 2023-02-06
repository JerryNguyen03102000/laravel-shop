<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slider';
    use HasFactory;
    protected $fillable = [
        'id','title','image','description','status'
    ];
    protected $primaryKey = 'id';
    public $timestamps = false;
}
