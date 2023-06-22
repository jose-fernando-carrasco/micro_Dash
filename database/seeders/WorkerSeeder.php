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

        Worker::create([
            'cod' => '4372666505625',
            'name' => 'Juan'
        ]);
        Worker::create([
            'cod' => '6407405411573',
            'name' => 'Maria'
        ]);
        Worker::create([
            'cod' => '4157094700968',
            'name' => 'Carlos'
        ]);
        Worker::create([
            'cod' => '1123777462728',
            'name' => 'Ana'
        ]);
        Worker::create([
            'cod' => '2656830670498',
            'name' => 'Luis'
        ]);
        Worker::create([
            'cod' => '1894689791181',
            'name' => 'Laura'
        ]);
        Worker::create([
            'cod' => '2367547451025',
            'name' => 'Jose'
        ]);
        Worker::create([
            'cod' => '8608522825964',
            'name' => 'Andrea'
        ]);

        
    }
}
