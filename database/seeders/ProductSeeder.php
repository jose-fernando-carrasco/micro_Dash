<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $productos = ['Camiseta', 'Zapatos', 'Pantalones', 'Bolso', 'Reloj', 'Gorra', 'Gafas', 'Perfume', 'Mochila', 'Telefono', 'Auriculares', 'Portatil', 'Camara', 'Bicicleta', 'Botella', 'Maleta', 'Vasos', 'cuchillos', 'Ace surf', 'chocolate'];

        // // Acceder a los nombres de productos
        // $minimo = 10; // Valor mínimo
        // $maximo = 600; // Valor máximo
        // $company_id = 1;
        // $cod = 0;
        // for ($i = 0; $i < count($productos); $i++) {
        //     $numeroRealRango = $minimo + ($maximo - $minimo) * mt_rand() / mt_getrandmax();

        //     $cod++;
        //     Product::create([
        //         'name' => $productos[$i],
        //         'cod' => $cod,
        //         'price' => $numeroRealRango,
        //         'amount' => rand(500,2000),
        //         'sale_price' => $numeroRealRango+rand(5,20),
        //         'company_id' => $company_id
        //     ]);

        //     if(($i+1) % 2 == 0)
        //         $company_id++;
        // }

        Product::create([
            'name' => 'Beef',
            'cod' => '4372666505625',
            'price' => 85,
            'amount' => 500,
            'sale_price' => 104,
            'company_id' => 1
        ]);

        Product::create([
            'name' => 'Shrimp',
            'cod' => '6407405411573',
            'price' => 67,
            'amount' => 850,
            'sale_price' => 80,
            'company_id' => 1
        ]);


        Product::create([
            'name' => 'Lamb',
            'cod' => '4157094700968',
            'price' => 100.62,
            'amount' => 500,
            'sale_price' => 130.45,
            'company_id' => 1
        ]);

        Product::create([
            'name' => 'Tea',
            'cod' => '1123777462728',
            'price' => 76.50,
            'amount' => 500,
            'sale_price' => 89.70,
            'company_id' => 1
        ]);

        Product::create([
            'name' => 'Cheese',
            'cod' => '2656830670498',
            'price' => 120.60,
            'amount' => 500,
            'sale_price' => 140.50,
            'company_id' => 1
        ]);

        Product::create([
            'name' => 'Steam',
            'cod' => '1894689791181',
            'price' => 69.99,
            'amount' => 500,
            'sale_price' => 90.30,
            'company_id' => 1
        ]);

        Product::create([
            'name' => 'Puree',
            'cod' => '2367547451025',
            'price' => 200.50,
            'amount' => 500,
            'sale_price' => 250.67,
            'company_id' => 1
        ]);

        Product::create([
            'name' => 'Peeled',
            'cod' => '8608522825964',
            'price' => 158.4,
            'amount' => 500,
            'sale_price' => 178.90,
            'company_id' => 1
        ]);

    }
}
