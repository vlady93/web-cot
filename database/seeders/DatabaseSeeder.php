<?php

namespace Database\Seeders;

use App\Models\elementos;
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
        $elemento =new elementos();
        $elemento->nombre="Plomo";
        $elemento->simbolo="Pb";
        $elemento->save();

        $elemento1 =new elementos();
        $elemento1->nombre="Plata";
        $elemento1->simbolo="Ag";
        $elemento1->save();

        $elemento6 =new elementos();
        $elemento6->nombre="Zinc";
        $elemento6->simbolo="Zn";
        $elemento6->save();


        $elemento2 =new elementos();
        $elemento2->nombre="Arsenico";
        $elemento2->simbolo="As";
        $elemento2->save();

        $elemento3 =new elementos();
        $elemento3->nombre="Antimonio";
        $elemento3->simbolo="Sb";
        $elemento3->save();

        $elemento4 =new elementos();
        $elemento4->nombre="Bismuto";
        $elemento4->simbolo="Bi";
        $elemento4->save();

        $elemento5 =new elementos();
        $elemento5->nombre="Estaño";
        $elemento5->simbolo="Sn";
        $elemento5->save();
        $elemento9 =new elementos();
        $elemento9->nombre="Hierro";
        $elemento9->simbolo="Fe";
        $elemento9->save();
        
        $elemento10 =new elementos();
        $elemento10->nombre="Oxido de Silicio";
        $elemento10->simbolo="SiO2";
        $elemento10->save();
        
        $elemento8 =new elementos();
        $elemento8->nombre="Arsenico+Antimonio";
        $elemento8->simbolo="As+Sb";
        $elemento8->save();
        
        $elemento7 =new elementos();
        $elemento7->nombre="Humedad";
        $elemento7->simbolo="H2O";
        $elemento7->save();

    }
}
