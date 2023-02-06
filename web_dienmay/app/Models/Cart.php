<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $table = 'cart';
    use HasFactory;
    protected $fillable=[
        'id','title','image','quantity','price','id_product'
    ];
    protected $primaryKey = 'id';
    public $timestamps = false;


    public function cart(){
        return $this->belongsTo(Product::class,'id_product','id');
    }
}
