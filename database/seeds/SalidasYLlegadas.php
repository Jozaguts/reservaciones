<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SalidasYLlegadas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,10) as $index) {
        DB::table('salidallegadas')->insert([
        'clave'=>$faker->year($max = 'now'),
        'nombre'=>$faker->name,
        'direccion'=>$faker->streetAddress, 
        'kml'=>$faker->buildingNumber, 
        'active'=>1,
        'remove'=>0,
        'longitud' => $faker-> longitude($min = -180, $max = 180),
        'latitud' => $faker->latitude($min = -90, $max = 90),
        'frame' => $faker->randomHtml(1,2),
        'usuarios_id' => \App\User::all()->random()->id,
        ]);
        }
    }
}
