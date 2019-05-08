<?php

use Faker\Generator as Faker;

$factory->define(SalidasLlegadas::class, function (Faker $faker) {
    return [
      
    'clave'=>$faker->year($max = 'now'),
    'nombre'=>$factory->name,
    'direccion'=>$faker->streetAddress, 
    'kml'=>$faker->buildingNumber, 
    'active'=>1,
    'remove'=>0,
    'usuarios_id' => \App\User::all()->random()->id,
    ];
});
