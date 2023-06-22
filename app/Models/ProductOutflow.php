<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOutflow extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function worker(){
        return $this->belongsTo(Worker::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

}
