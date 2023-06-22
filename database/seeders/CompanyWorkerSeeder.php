<?php

namespace Database\Seeders;

use App\Models\CompanyWorker;
use Illuminate\Database\Seeder;

class CompanyWorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $j = 0;
        for ($i = 1; $i <=10; $i++) {//empresas
            $j++;
            CompanyWorker::create([
                'worker_id' => $j,
                'company_id' => $i
            ]);
            $j++;
            CompanyWorker::create([
                'worker_id' => $j,
                'company_id' => $i
            ]);
        }
        
    }
}
