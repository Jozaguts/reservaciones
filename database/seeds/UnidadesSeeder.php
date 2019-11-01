<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UnidadesSeeder extends Seeder
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
            DB::table('unidades')->insert([
            'clave' => $faker->randomElement($array = array ('MT01','CM01','KY03','CMT3','MT02','LA02','LA01',)),
            'placa'=> $faker->userName,
            'capacidad'=> $faker->numberBetween($min = 1, $max = 40),
            'descripcion'=> $faker->sentence($nbWords = 6, $variableNbWords = true),
            'color'=> $faker->safeColorName,
            'active'=> 1,
            'remove'=>0,
            'idusuario'=> $faker->numberBetween($min = 1, $max = 3),
            'idtipounidad'=>$faker->numberBetween($min = 1, $max = 5),
            ]);
        }


        

         
    }
}
