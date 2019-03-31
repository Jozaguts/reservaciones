<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RolesTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(TipoUnidadSeeder::class);
        //   $this->call(UnidadesSeeder::class);
        //   $this->call(TipoActividadSeeder::class);
          $this->call(DiasTableSeeder::class);
         
    }
}
