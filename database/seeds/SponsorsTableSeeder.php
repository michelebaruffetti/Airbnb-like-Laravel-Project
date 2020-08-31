<?php

use Illuminate\Database\Seeder;

use App\Sponsor;

class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorizzazioni = config('sponsors');
        foreach ($sponsorizzazioni as $sponsorizzazione) {
            $nuova_sponsorizzazione = new Sponsor;
            $nuova_sponsorizzazione->price = $sponsorizzazione['prezzo'];
            $nuova_sponsorizzazione->description = $sponsorizzazione['descrizione'];
            $nuova_sponsorizzazione->save();
        }
    }
}
