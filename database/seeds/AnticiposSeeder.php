<?php

use Illuminate\Database\Seeder;
Use App\Anticipos;

class AnticiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $anticipo = new Anticipos;

        $anticipo::create([
        'nombre' => 'Sin Anticipo',
        'porcentaje'=>0,
        'active'=>1,
        'remove'=> 0,
        'usuarios_id'=>1
        ]);
     

        $anticipo::create([
        'nombre' => '10% Anticipo Minimo',
        'porcentaje'=>10,
        'active'=>1,
        'remove'=> 0,
        'usuarios_id'=>1
        ]);
 
        $anticipo::create([
        'nombre' => '25% Anticipo ',
        'porcentaje'=>25,
        'active'=>1,
        'remove'=> 0,
        'usuarios_id'=>1
        ]);
        

        $anticipo::create([
        'nombre' => '50% Anticipo ',
        'porcentaje'=>50,
        'active'=>1,
        'remove'=> 0,
        'usuarios_id'=>1
        ]);
        

        $anticipo::create([
        'nombre' => '75% Anticipo ',
        'porcentaje'=>75,
        'active'=>1,
        'remove'=> 0,
        'usuarios_id'=>1
        ]);
        

        $anticipo::create([
        'nombre' => '100% Completo ',
        'porcentaje'=>100,
        'active'=>1,
        'remove'=> 0,
        'usuarios_id'=>1
        ]);
        
    }
}
