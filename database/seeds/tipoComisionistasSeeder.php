<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class tipoComisionistasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<=5; $i++){
            DB::table('tipocomisionistas')->insert([
                'idusuario' => 1,
                'clave' => Str::random(5),
                'nombre' => Str::random(10),
                'active' => 1,
                'remove' => 0
            ]);

        }

    }
}
