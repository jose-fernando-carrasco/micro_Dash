<?php

namespace Database\Seeders;

use App\Models\Worker;
use Illuminate\Database\Seeder;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $works = ['Juan Garcia','Maria Rodriguez','Carlos Lopez','Ana Martinez','Luis Gonzalez','Laura Hernandez','Jose Perez','Andrea Sanchez','Antonio Torres','Carmen Ramirez','Manuel Jimenez','Patricia Vargas','Alejandro Silva','Gabriela Morales','Daniel Castro','Sofia Ortega','Pedro Ruiz','Natalia Medina','Ricardo Morales','Isabella Fernandez'];
        $cod = 0;
        foreach ($works as $work) {
            $cod++;
            Worker::create([
                'cod' => $cod,
                'name' => $work
            ]);
        }

        
    }
}
