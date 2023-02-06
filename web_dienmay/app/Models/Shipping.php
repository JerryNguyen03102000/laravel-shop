<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Shipping extends Model
{
    use HasFactory;
    protected $table = 'shipping';
    use HasFactory;
    protected $fillable=[
        'id','name','phone','address','email','cod'
    ];
    protected $primaryKey = 'id';
    public $timestamps = false;
    public function order(){
        return $this->hasMany(Order::class,'ship_id', 'id');
    }
}
