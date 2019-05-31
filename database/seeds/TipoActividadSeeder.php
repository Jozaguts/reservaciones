<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class TipoActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,5) as $index) {
            DB::table('tipoactividades')->insert([
            'clave' => $faker->randomElement($array = array ('MT011','CM011','KY031','CMT31','MT021','LA021','LA011',)),
            'nombre'=> $faker->unique()->randomElement($array = array ('Motos','Canopy','Rio','Lanchas','Paseo en Bote','Paracaidas',)),
            'color'=> $faker->safeColorName,
            'active'=> 1,
            'remove'=>0,
            'tipounidad_id'=> $faker->numberBetween($min = 1, $max = 5),
            'usuarios_id'=> $faker->numberBetween($min = 1, $max = 3),
       
            ]);
    }
}
}
