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
            'nombre' => 'Persona 1',
            'active'=> 1,
            'remove'=>0
            ]);
            $persona::create([
                'nombre' => 'Persona 2',
                'active'=> 1,
                'remove'=>0
                ]);
                $persona::create([
                    'nombre' => 'Persona 3',
                    'active'=> 1,
                    'remove'=>0
                    ]);
    }
}
