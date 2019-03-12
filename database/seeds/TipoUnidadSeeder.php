<?php

use Illuminate\Database\Seeder;
use App\TipoUnidad;

class TipoUnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //  $tipounidad = TipoUnidad::create([
    //      'nombre' => 'Moto',
    //      'combustible'=> 'gasolina',
    //      'medio'=> 'terrestre',
    //      'remove'=> 0,
    //      'active'=> 1,
    //      'idusuario'=>1
    //      ]);
         $tipounidad = TipoUnidad::create([
            'nombre' => 'Cuatrimoto',
            'combustible'=> 'gasolina',
            'medio'=> 'terrestre',
            'remove'=> 0,
            'active'=> 1,
            'idusuario'=>2
            ]);
            
         $tipounidad = TipoUnidad::create([
            'nombre' => 'Camion A',
            'combustible'=> 'gasolina',
            'medio'=> 'terrestre',
            'remove'=> 0,
            'active'=> 1,
            'idusuario'=>2
            ]);
            
         $tipounidad = TipoUnidad::create([
            'nombre' => 'Lancha',
            'combustible'=> 'gasolina',
            'medio'=> 'acuatico',
            'remove'=> 0,
            'active'=> 1,
            'idusuario'=>3
            ]);
            
         $tipounidad = TipoUnidad::create([
            'nombre' => 'Kayak',
            'combustible'=> '',
            'medio'=> 'acuatico',
            'remove'=> 0,
            'active'=> 1,
            'idusuario'=>1
            ]);
    }
}
