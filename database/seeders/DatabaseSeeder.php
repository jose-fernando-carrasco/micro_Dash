<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CompanySeeder::class);
        $this->call(WorkerSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductOutflowSeeder::class);
        $this->call(CompanyWorkerSeeder::class);
        
    }
}
