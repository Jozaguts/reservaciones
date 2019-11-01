<?php

use Illuminate\Database\Seeder;
use App\UnidadesHorario;

class UnidadesHorarioseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $horario = UnidadesHorario::create([
            'dia' => 'Flight 10'
            ]);
    }
}
