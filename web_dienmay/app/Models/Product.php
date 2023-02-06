<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brands;
use App\Models\Category;
class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    use HasFactory;
    protected $fillable=[
        'id','title','slug','image','description','status','id_category','id_brand'
    ];
    protected $primaryKey = 'id';
    public $timestamps = false;
    public function brand()
    {
        return $this->belongsTo(Brands::class,'id_brand','id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'id_category','id');
    }
    public function cart()
    {
        return $this->hasOne(Cart::class,'id_product','id');
    }
}
