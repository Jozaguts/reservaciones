<?php

use Illuminate\Database\Seeder;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //rol operador
      $operador = User::create([
        'first_name' => 'Jose Sagit',
        'last_name' => 'Gutierrez Terrazas',        
        'department' => 'Ventas',
         'active'=>'1',
        'removed'=>'0',
        'email' => 'jozaguts@gmail.com',
        'password' =>bcrypt('Reservaciones.1')

      ]);
      $operador->assignRole('operador');
      
       $supervisor = User::create([
        'first_name' => 'Alejandro',
        'last_name' => 'Gutierrez Terrazas',        
        'department' => 'Administracion', 
        'email' => 'alejandro@gmail.com',
        'active'=>'1',
        'removed'=>'0',
        'password' =>bcrypt('Reservaciones.1')

      ]);
      $supervisor->assignRole('supervisor');

      $administrador = User::create([
        'first_name' => 'Jesús',
        'last_name' => 'Gutierrez Terrazas',        
        'department' => 'Ventas', 
        'email' => 'jesus@gmail.com',
        'active'=>'1',
        'removed'=>'0',
        'password' =>bcrypt('Reservaciones.1')
        
      ]);
      $administrador->assignRole('administrador');

    }
}
