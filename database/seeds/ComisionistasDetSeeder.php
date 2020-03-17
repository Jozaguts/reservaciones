<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComisionistasDetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<=50; $i++) {
            DB::table('comisionistadet')->insert([
                'porcentaje' => random_int(10,100),
                'importe' => random_int(100,1000),
                'cupon' => random_int(1,100),
                'meta' => random_int(2000, 7000),
                'precio' => random_int(400, 1500),
                'idusuario' => 1,
                'idcomisionista' => random_int(1,10),
                'idactividad' => 1,
            ]);
        }
    }
}
