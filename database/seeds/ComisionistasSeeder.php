<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ComisionistasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<=10; $i++  ) {
           DB::table('comisionistas')->insert([
               'clave' => Str::random(5),
               'nombre'=> Str::random(15),
               'empleado' => random_int(0,1),
               'facturable' => random_int(0,1),
               'whats' => rand(100000000,900000000),
               'movil' => rand(100000000,900000000),
               'telefono' => rand(100000000,900000000),
               'email'=> Str::random(8). '@test.com',
               'fecnac'=> date('Y-m-d'),
               'active' =>1,
               'remove'=>0,
               'idusuario'=> 1,
               'idtipocomisionista' => random_int(1,5)
            ]);
        }
    }
}
