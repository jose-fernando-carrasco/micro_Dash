<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    public function productOutflows(){
        return $this->hasMany(ProductOutflow::class);
    }

    public function companyWorkers(){
        return $this->hasMany(CompanyWorker::class);
    }

}
