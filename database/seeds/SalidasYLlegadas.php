<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SalidasYLlegadas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('salidallegadas')->insert([
            'clave'=>'SL01',
            'nombre'=>'Jarretaderas, Oxxo',
            'direccion'=>'México 200, 63735 Las Jarretaderas, Nay.', 
            'kml'=>'20.695999999999998, -105.2672778', 
            'active'=>1,
            'remove'=>0,
            'longitud' => '105.267262',
            'latitud' => '20.696004',
            'frame' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d409.18270157081224!2d-105.26750345442854!3d20.695991869654623!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8421479441a2d28b%3A0x6647957493e9034e!2sOXXO!5e0!3m2!1ses!2smx!4v1559277066687!5m2!1ses!2smx" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>',
            'usuarios_id' => \App\User::all()->random()->id,
            ]);

            DB::table('salidallegadas')->insert([
                'clave'=>'SL02',
                'nombre'=>'Oficinas, Canopy El Eden',
                'direccion'=>'Clemente Orozco S/N, Zona Hotelera, Las Glorias, 48380 Puerto Vallarta, Jal.', 
                'kml'=>'20.633425, -105.231213', 
                'active'=>1,
                'remove'=>0,
                'longitud' => '105.231213',
                'latitud' => '20.633425',
                'frame' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1901.235971558978!2d-105.230820394034!3d20.63326396993907!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x84214f7e1610dcb1%3A0x31e43450feac8a72!2sCanopy+El+Eden!5e0!3m2!1ses!2smx!4v1559277659541!5m2!1ses!2smx" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>',
                'usuarios_id' => \App\User::all()->random()->id,
                ]);
    }
}
