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

        // for ($i = 0; $i < 10; $i++) {
            
        //     $j++;
        //     ProductOutflow::create([
        //         'quantity' => rand(59, 900),
        //         'fecha' => $fechas[$j],
        //         'worker_id' => 1,
        //         'product_id' => 1,
        //         'company_id' => 1
        //     ]);

        //     $j++;
        //     ProductOutflow::create([
        //         'quantity' => rand(59,900),
        //         'fecha' => $fechas[$j],
        //         'worker_id' => 2,
        //         'product_id' => 2,
        //         'company_id' => 1
        //     ]);
        
        // }


        // for ($i = 0; $i < 20; $i++) {

        //     ProductOutflow::create([
        //         'quantity' => rand(103,500),
        //         'fecha' => $fechas[$i],
        //         'worker_id' => 2,
        //         'product_id' => 2,
        //         'company_id' => 1
        //     ]);
        
        // }


        ProductOutflow::create([ 'quantity'=> 289, 'fecha'=> '2019-12-24', 'worker_id'=> 3, 'product_id'=> 5, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 238, 'fecha'=> '2023-03-16', 'worker_id'=> 5, 'product_id'=> 1, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 249, 'fecha'=> '2020-04-19', 'worker_id'=> 6, 'product_id'=> 4, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 295, 'fecha'=> '2020-11-19', 'worker_id'=> 5, 'product_id'=> 5, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 103, 'fecha'=> '2019-06-21', 'worker_id'=> 7, 'product_id'=> 3, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 261, 'fecha'=> '2019-12-12', 'worker_id'=> 7, 'product_id'=> 7, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 56,  'fecha'=> '2021-09-21', 'worker_id'=> 8, 'product_id'=> 3, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 284, 'fecha'=> '2020-08-14', 'worker_id'=> 6, 'product_id'=> 8, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 162, 'fecha'=> '2021-05-28', 'worker_id'=> 7, 'product_id'=> 5, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 278, 'fecha'=> '2022-03-17', 'worker_id'=> 4, 'product_id'=> 5, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 175, 'fecha'=> '2021-07-16', 'worker_id'=> 8, 'product_id'=> 2, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 69,  'fecha'=> '2019-07-10', 'worker_id'=> 2, 'product_id'=> 4, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 245, 'fecha'=> '2022-01-07', 'worker_id'=> 6, 'product_id'=> 4, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 252, 'fecha'=> '2021-06-20', 'worker_id'=> 8, 'product_id'=> 4, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 88,  'fecha'=> '2021-05-07', 'worker_id'=> 2, 'product_id'=> 1, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 282, 'fecha'=> '2021-05-27', 'worker_id'=> 3, 'product_id'=> 8, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 135, 'fecha'=> '2020-04-14', 'worker_id'=> 1, 'product_id'=> 1, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 282, 'fecha'=> '2020-01-17', 'worker_id'=> 4, 'product_id'=> 4, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 163, 'fecha'=> '2020-05-13', 'worker_id'=> 2, 'product_id'=> 7, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 221, 'fecha'=> '2022-01-16', 'worker_id'=> 5, 'product_id'=> 1, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 234, 'fecha'=> '2020-10-09', 'worker_id'=> 6, 'product_id'=> 8, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 297, 'fecha'=> '2022-12-26', 'worker_id'=> 5, 'product_id'=> 7, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 194, 'fecha'=> '2023-05-13', 'worker_id'=> 6, 'product_id'=> 4, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 54,  'fecha'=> '2019-07-23', 'worker_id'=> 6, 'product_id'=> 6, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 100, 'fecha'=> '2019-11-26', 'worker_id'=> 6, 'product_id'=> 3, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 103, 'fecha'=> '2022-06-16', 'worker_id'=> 3, 'product_id'=> 8, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 236, 'fecha'=> '2023-01-08', 'worker_id'=> 8, 'product_id'=> 4, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 139, 'fecha'=> '2020-12-23', 'worker_id'=> 7, 'product_id'=> 7, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 280, 'fecha'=> '2020-09-02', 'worker_id'=> 4, 'product_id'=> 4, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 188, 'fecha'=> '2019-10-16', 'worker_id'=> 6, 'product_id'=> 5, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 200, 'fecha'=> '2020-06-09', 'worker_id'=> 6, 'product_id'=> 2, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 224, 'fecha'=> '2019-05-23', 'worker_id'=> 1, 'product_id'=> 8, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 298, 'fecha'=> '2020-01-22', 'worker_id'=> 5, 'product_id'=> 6, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 149, 'fecha'=> '2020-03-02', 'worker_id'=> 6, 'product_id'=> 7, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 66,  'fecha'=> '2021-12-09', 'worker_id'=> 3, 'product_id'=> 8, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 213, 'fecha'=> '2022-11-09', 'worker_id'=> 2, 'product_id'=> 2, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 248, 'fecha'=> '2019-10-18', 'worker_id'=> 3, 'product_id'=> 2, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 182, 'fecha'=> '2019-02-03', 'worker_id'=> 5, 'product_id'=> 4, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 90,  'fecha'=> '2020-07-05', 'worker_id'=> 3, 'product_id'=> 3, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 251, 'fecha'=> '2023-02-27', 'worker_id'=> 3, 'product_id'=> 6, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 92,  'fecha'=> '2020-11-18', 'worker_id'=> 7, 'product_id'=> 5, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 229, 'fecha'=> '2021-07-29', 'worker_id'=> 8, 'product_id'=> 1, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 269, 'fecha'=> '2022-04-29', 'worker_id'=> 1, 'product_id'=> 8, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 228, 'fecha'=> '2020-04-03', 'worker_id'=> 3, 'product_id'=> 7, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 251, 'fecha'=> '2019-04-29', 'worker_id'=> 8, 'product_id'=> 6, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 300, 'fecha'=> '2021-02-02', 'worker_id'=> 3, 'product_id'=> 8, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 220, 'fecha'=> '2022-02-18', 'worker_id'=> 7, 'product_id'=> 8, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 160, 'fecha'=> '2019-08-31', 'worker_id'=> 1, 'product_id'=> 6, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 294, 'fecha'=> '2022-06-26', 'worker_id'=> 6, 'product_id'=> 8, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 137, 'fecha'=> '2023-03-26', 'worker_id'=> 2, 'product_id'=> 6, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 133, 'fecha'=> '2021-10-10', 'worker_id'=> 8, 'product_id'=> 1, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 113, 'fecha'=> '2019-07-20', 'worker_id'=> 6, 'product_id'=> 6, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 117, 'fecha'=> '2020-03-08', 'worker_id'=> 1, 'product_id'=> 7, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 236, 'fecha'=> '2021-02-19', 'worker_id'=> 4, 'product_id'=> 7, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 275, 'fecha'=> '2023-03-05', 'worker_id'=> 2, 'product_id'=> 5, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 112, 'fecha'=> '2021-12-08', 'worker_id'=> 4, 'product_id'=> 3, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 136, 'fecha'=> '2022-02-06', 'worker_id'=> 6, 'product_id'=> 2, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 196, 'fecha'=> '2020-09-12', 'worker_id'=> 5, 'product_id'=> 6, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 103, 'fecha'=> '2022-04-05', 'worker_id'=> 6, 'product_id'=> 7, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 192, 'fecha'=> '2023-01-22', 'worker_id'=> 5, 'product_id'=> 2, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 147, 'fecha'=> '2020-03-24', 'worker_id'=> 7, 'product_id'=> 4, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 188, 'fecha'=> '2020-12-28', 'worker_id'=> 5, 'product_id'=> 3, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 93,  'fecha'=> '2022-10-29', 'worker_id'=> 4, 'product_id'=> 8, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 166, 'fecha'=> '2020-04-01', 'worker_id'=> 7, 'product_id'=> 1, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 148, 'fecha'=> '2021-12-13', 'worker_id'=> 2, 'product_id'=> 8, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 267, 'fecha'=> '2023-04-29', 'worker_id'=> 2, 'product_id'=> 5, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 270, 'fecha'=> '2020-10-08', 'worker_id'=> 8, 'product_id'=> 7, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 246, 'fecha'=> '2023-02-27', 'worker_id'=> 6, 'product_id'=> 2, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 120, 'fecha'=> '2022-01-24', 'worker_id'=> 5, 'product_id'=> 2, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 153, 'fecha'=> '2019-09-23', 'worker_id'=> 5, 'product_id'=> 5, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 206, 'fecha'=> '2020-03-29', 'worker_id'=> 8, 'product_id'=> 5, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 270, 'fecha'=> '2019-10-02', 'worker_id'=> 6, 'product_id'=> 6, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 103, 'fecha'=> '2022-04-29', 'worker_id'=> 1, 'product_id'=> 4, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 78,  'fecha'=> '2021-08-15', 'worker_id'=> 5, 'product_id'=> 3, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 144, 'fecha'=> '2021-02-05', 'worker_id'=> 1, 'product_id'=> 4, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 274, 'fecha'=> '2022-06-23', 'worker_id'=> 7, 'product_id'=> 8, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 183, 'fecha'=> '2020-01-06', 'worker_id'=> 1, 'product_id'=> 3, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 247, 'fecha'=> '2022-06-01', 'worker_id'=> 2, 'product_id'=> 7, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 104, 'fecha'=> '2020-09-16', 'worker_id'=> 3, 'product_id'=> 1, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 55,  'fecha'=> '2021-08-23', 'worker_id'=> 2, 'product_id'=> 4, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 230, 'fecha'=> '2021-12-25', 'worker_id'=> 4, 'product_id'=> 5, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 86,  'fecha'=> '2022-12-12', 'worker_id'=> 4, 'product_id'=> 8, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 136, 'fecha'=> '2021-03-19', 'worker_id'=> 4, 'product_id'=> 4, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 110, 'fecha'=> '2020-01-28', 'worker_id'=> 8, 'product_id'=> 8, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 257, 'fecha'=> '2021-01-18', 'worker_id'=> 8, 'product_id'=> 3, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 205, 'fecha'=> '2021-12-15', 'worker_id'=> 8, 'product_id'=> 1, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 103, 'fecha'=> '2022-07-28', 'worker_id'=> 7, 'product_id'=> 8, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 74,  'fecha'=> '2021-10-14', 'worker_id'=> 3, 'product_id'=> 2, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 102, 'fecha'=> '2020-09-29', 'worker_id'=> 1, 'product_id'=> 3, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 145, 'fecha'=> '2019-12-23', 'worker_id'=> 7, 'product_id'=> 2, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 227, 'fecha'=> '2021-11-15', 'worker_id'=> 7, 'product_id'=> 6, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 154, 'fecha'=> '2021-10-06', 'worker_id'=> 8, 'product_id'=> 3, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 146, 'fecha'=> '2020-09-07', 'worker_id'=> 2, 'product_id'=> 2, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 266, 'fecha'=> '2022-04-11', 'worker_id'=> 2, 'product_id'=> 8, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 258, 'fecha'=> '2019-06-14', 'worker_id'=> 2, 'product_id'=> 7, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 127, 'fecha'=> '2020-06-28', 'worker_id'=> 2, 'product_id'=> 6, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 102, 'fecha'=> '2020-01-09', 'worker_id'=> 5, 'product_id'=> 4, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 185, 'fecha'=> '2019-05-07', 'worker_id'=> 6, 'product_id'=> 4, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 68,  'fecha'=> '2020-10-19', 'worker_id'=> 1, 'product_id'=> 2, 'company_id'=> 1]);
        ProductOutflow::create([ 'quantity'=> 172, 'fecha'=> '2021-01-26', 'worker_id'=> 3, 'product_id'=> 4, 'company_id'=> 1]);


    }
}
