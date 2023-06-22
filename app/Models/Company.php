<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function companyWorkers(){
        return $this->hasMany(CompanyWorker::class);
    }

    public function productOutflows(){
        return $this->hasMany(ProductOutflow::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
    
}
