<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UnidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1,3) as $index) {
	        DB::table('unidades')->insert([
            'clave' => 'mot',
            'placa'=> '12qw',
            'capacidad'=> '2',
            'descripcion'=> 'Moto Acuatica para dos personas',
            'color'=> 'rojo',
            'active'=> 1,
            'remove'=>0,
            'idusuario'=>2,
            'idtipounidad'=>2,
            ]);
            }
            foreach (range(4,6) as $index) {
                DB::table('unidades')->insert([
                    'clave' => 'aut',
                    'placa'=> '13ds3qw',
                    'capacidad'=> '40',
                    'descripcion'=> 'Autobus para 40 personas',
                    'color'=> 'Amarillo',
                    'active'=> 1,
                    'remove'=>0,
                    'idusuario'=>1,
                    'idtipounidad'=>1,
                ]);
                }
        

         
    }
}
