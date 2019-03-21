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


        // foreach (range(1,3) as $index) {
	    //     DB::table('unidades')->insert([
        //     'clave' => 'Mt01',
        //     'placa'=> 'Mt01',
        //     'capacidad'=> '2',
        //     'descripcion'=> 'Moto para dos personas Editado',
        //     'color'=> 'rojo',
        //     'active'=> 1,
        //     'remove'=>0,
        //     'idusuario'=>2,
        //     'idtipounidad'=>1,
        //     ]);
        //     }
        //     foreach (range(4,6) as $index) {
        //         DB::table('unidades')->insert([
        //             'clave' => 'Mt02',
        //             'placa'=> '13ds3qw',
        //             'capacidad'=> '40',
        //             'descripcion'=> 'Autobus para 40 personas',
        //             'color'=> 'Amarillo',
        //             'active'=> 1,
        //             'remove'=>0,
        //             'idusuario'=>1,
        //             'idtipounidad'=>1,
        //         ]);
        //         }
        

         
    }
}
