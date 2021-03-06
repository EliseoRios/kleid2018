<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsuariosSeeder::class);
        $this->call(MenusSeeder::class);
        $this->call(PermisosSeeder::class);
        $this->call(DepartamentosSeeder::class);
        $this->call(ParametrosSeeder::class);
    }
}
