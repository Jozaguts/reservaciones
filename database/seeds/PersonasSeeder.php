<?php

use Illuminate\Database\Seeder;
use App\Personas;

class PersonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $persona = new Personas;

        $persona::create([
            'nombre' => 'Adulto',
            'active'=> 1,
            'remove'=>0
            ]);
        $persona::create([
            'nombre' => 'Niño',
            'active'=> 1,
            'remove'=>0
            ]);
        $persona::create([
            'nombre' => 'Estudiante',
            'active'=> 1,
            'remove'=>0
            ]);
    }
}
