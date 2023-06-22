<?php

namespace Database\Seeders;

use App\Models\ProductOutflow;
use Illuminate\Database\Seeder;

class ProductOutflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $fechas = ['2022-01-01','2022-01-18','2022-01-21','2022-01-24','2022-02-10','2022-02-15','2022-02-21','2022-03-02','2022-03-09','2022-04-03','2022-04-21','2022-05-07','2022-05-17','2022-06-08','2022-06-13','2022-06-20','2022-06-24','2022-06-26','2022-06-27','2022-06-28'];
        $j = -1;

        for ($i = 0; $i < 10; $i++) {
            
            $j++;
            ProductOutflow::create([
                'quantity' => rand(59, 900),
                'fecha' => $fechas[$j],
                'worker_id' => 1,
                'product_id' => 1,
                'company_id' => 1
            ]);

            $j++;
            ProductOutflow::create([
                'quantity' => rand(59,900),
                'fecha' => $fechas[$j],
                'worker_id' => 2,
                'product_id' => 2,
                'company_id' => 1
            ]);
        
        }


        // for ($i = 1; $i <= 10; $i++) {
        //     //Empresa i
        //     $j++;
        //     ProductOutflow::create([
        //         'quantity' => rand(5, 99),
        //         'fecha' => $fechas[$j],
        //         'worker_id' => $j,
        //         'product_id' => $j,
        //         'company_id' => $i
        //     ]);
        //     $j++;
        //     ProductOutflow::create([
        //         'quantity' => rand(5, 99),
        //         'fecha' => $fechas[$j],
        //         'worker_id' => $j,
        //         'product_id' => $j,
        //         'company_id' => $i
        //     ]);
        // }

        

    }
}
