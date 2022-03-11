<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shop extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->hasMany(product::class,"product_id");
    }
    protected $fillable=['shop_name','address','email','image'];
}
