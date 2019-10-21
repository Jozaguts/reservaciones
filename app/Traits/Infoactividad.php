<?php
 
namespace App\Traits;

use App\Actividades;
use App\ComboDet;
use Carbon\Carbon;


trait Infoactividad {

    public function getInfoactividad($id,$id_combo_det=null ){

        $infoActividad = [];

        $actividadesHorarios= Actividades::find($id)
        ->horarios()
        ->get();
  
        $options = [];
        
            for ($i=0; $i < count($actividadesHorarios) ; $i++) { 
        
                $selecthini = Carbon::createFromFormat('H:m:s', $actividadesHorarios[$i]->hini)->format('H:s');   
                $selecthfin = Carbon::createFromFormat('H:m:s', $actividadesHorarios[$i]->hfin)->format('H:s');
                
                $type = $actividadesHorarios[$i]->libre ==1 ? 'Libre':'Multiple';

                $l = $actividadesHorarios[$i]->l ==1 ? "L": ""; 
                $m = $actividadesHorarios[$i]->m ==1 ? "M": ""; 
                $x = $actividadesHorarios[$i]->x ==1 ? "X": ""; 
                $j = $actividadesHorarios[$i]->j ==1 ? "J": ""; 
                $v = $actividadesHorarios[$i]->v ==1 ? "V": ""; 
                $s = $actividadesHorarios[$i]->s ==1 ? "S": ""; 
                $d = $actividadesHorarios[$i]->d ==1 ? "D": "";

                $horario='';
                
                 
                    $id= $actividadesHorarios[$i]->id;
                    
                $options[] = "<option name='horario_id' value='$id'  data-type='$type'> $selecthini | $selecthfin | $l $m $x $j $v $s $d </option>"; 
        

         
        
            }
      

        return  $options;
     
        
        
        
    }

}