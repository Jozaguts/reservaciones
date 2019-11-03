<?php

use Illuminate\Database\Seeder;
use App\Actividades;
use App\ActividadPrecios;
use App\ActividadesHorario;
use App\SalidasLlegadasHorario;

class ActividadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actividad = new Actividades;

        $actividad->create([
        'clave' => 'Libre',
        'nombre' => 'Actividad Libre',
        'tipoactividades_id' => '1',
        'fijo' => '0',
        'renta' => '0',
        'active' => '1',
        'remove' => '0',
        'duracion' => '120',
        'minutoincrementa' => '10',
        'montoincremento' => '100',
        'maxcortesias' => '5',
        'maxcupones' => '2',
        'anticipo_id' => '1',
        'idusuario' => '3',
        'tipounidades_id' => '1',
        'precio' => '100',
        'balance' => '200',
        'promocion' => '1',
        'combo' => '0',
        'observaciones' => 'Sin Observaciones',
        'requisitos' => 'No',
        'riesgo' => '0',
        'puntos' => '10',
        'libre' => '1',
        ]);
        
        

        $ActividadPrecios = new ActividadPrecios;

        for ($i=1; $i <=3; $i++) { 
        
            $ActividadPrecios->create([
                'actividad_id' => 1,
                'persona_id' => $i, 
                'precio1' => '100',
                'precio2'=> '200',
                'precio3'=> '300',
                'doble'=> '200',
                'doblebalanc'=> '300',
                'triple'=> '600',
                'triplebalanc'=> '900',
                'promocion'=> '1',
                'restriccion'=>'1',
                'active'=> '1',
                'acompanante'=> '1',
                'remove'=> '0',
                'usuario_id'=> '3',
            ]);

           
        
        }

        $ActividadesHorario = new ActividadesHorario;
        $ActividadesHorario->create(
            [
                'actividades_id' => 1,                        
                'hini' => '08:00:00',
                'hfin' => '15:00:00',
                'l'=> '1',
                'm'=> '1',
                'x'=> '1',
                'j'=> '1',
                'v'=> '1',
                's'=> '1',
                'd'=> '1',
                'active'=> 1,
                'remove'=> 0,
                'usuarios_id'=> '3',
                'libre'=> '1'                         
            ]
           
        );
       
        $SalidasLlegadasHorario = new SalidasLlegadasHorario;
        $SalidasLlegadasHorario->create(
            [
                'actividadeshorario_id' => 1,
                'salidallegadas_id' => 1,
                'salida' =>1 , 
                'hora' =>null,
                'active' =>1,
                'remove' =>0,                        
                'usuarios_id' =>3,
            ]);
            
            $SalidasLlegadasHorarioLLEGADA = new SalidasLlegadasHorario;
            $SalidasLlegadasHorarioLLEGADA->create(
            [
                'actividadeshorario_id' => 1,
                'salidallegadas_id' => 1,
                'salida'=>0 , 
                'hora' =>null,
                'active' =>1,
                'remove' =>0,                        
                'usuarios_id' => '3',
            ]);  

    }
}
