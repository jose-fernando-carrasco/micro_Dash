<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $empresas = ['Acme Corporation','XYZ Industries','Smith & Co','Global Enterprises','MegaCorp Ltd','Innovative Solutions','Elite Services','Summit Group','Prime Manufacturing','Visionary Technologies'];
        for ($i = 0; $i < count($empresas); $i++) {
            Company::create([ 'name' => $empresas[$i] ]);
        }
        
    }
}
