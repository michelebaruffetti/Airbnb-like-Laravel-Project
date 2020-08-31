<?php

use Illuminate\Database\Seeder;

use App\Service;
class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = config('apartmentservices');
        for ($i=0; $i < count($services) ; $i++) {
            $nuovo_servizio = new Service();
            $nuovo_servizio->description = $services[$i];
            $nuovo_servizio->save();

        }
    }
}
