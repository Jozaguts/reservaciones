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
            'clave' => 'Mt01',
            'placa'=> 'Mt01',
            'capacidad'=> '2',
            'descripcion'=> 'Moto para dos personas Editado',
            'color'=> 'rojo',
            'active'=> 1,
            'remove'=>0,
            'idusuario'=>2,
            'idtipounidad'=>1,
            ]);
            }
            foreach (range(4,6) as $index) {
                DB::table('unidades')->insert([
                    'clave' => 'Mt02',
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
