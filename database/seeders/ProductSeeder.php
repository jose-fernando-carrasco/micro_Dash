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
        $productos = ['Camiseta', 'Zapatos', 'Pantalones', 'Bolso', 'Reloj', 'Gorra', 'Gafas', 'Perfume', 'Mochila', 'Telefono', 'Auriculares', 'Portatil', 'Camara', 'Bicicleta', 'Botella', 'Maleta', 'Vasos', 'cuchillos', 'Ace surf', 'chocolate'];

        // Acceder a los nombres de productos
        $minimo = 10; // Valor mínimo
        $maximo = 600; // Valor máximo
        $company_id = 1;
        $cod = 0;
        for ($i = 0; $i < count($productos); $i++) {
            $numeroRealRango = $minimo + ($maximo - $minimo) * mt_rand() / mt_getrandmax();
            
            $cod++;
            Product::create([
                'name' => $productos[$i],
                'cod' => $cod,
                'price' => $numeroRealRango,
                'amount' => rand(500,2000),
                'sale_price' => $numeroRealRango+rand(5,20),
                'company_id' => $company_id
            ]);

            if(($i+1) % 2 == 0)
                $company_id++;
        }

        
    }
}
