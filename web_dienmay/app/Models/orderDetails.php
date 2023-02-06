<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderDetails extends Model
{

    protected $table = 'order_details';
    use HasFactory;
    protected $fillable=[
        'id','order_code','id_product','quantity'
    ];
    protected $primaryKey = 'id';
    public $timestamps = false;
}
