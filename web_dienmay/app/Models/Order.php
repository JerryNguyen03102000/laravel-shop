<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    use HasFactory;

    protected $fillable = [
        'id', 'order_code', 'status', 'ship_id'
    ];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function ship()
    {
        return $this->belongsTo(Shipping::class, 'ship_id', 'id');

    }

}
