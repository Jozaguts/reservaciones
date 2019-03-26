<?php

use Illuminate\Database\Seeder;
use App\Dias;

class DiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dia = Dias::create([
        'dia' => 'L'
        ]);
        $dia = Dias::create([
        'dia' => 'M'
        ]);
        $dia = Dias::create([
        'dia' => 'X'
        ]);
        $dia = Dias::create([
        'dia' => 'J'
        ]);
        $dia = Dias::create([
        'dia' => 'V'
        ]);
        $dia = Dias::create([
        'dia' => 'S'
        ]);
        $dia = Dias::create([
        'dia' => 'D'
        ]);
                                    
    }
}
