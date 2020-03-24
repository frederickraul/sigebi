<?php

use Illuminate\Database\Seeder;
use App\Role;


class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'docente';
        $role->description = 'Docente';
        $role->save();
        $role = new Role();
        $role->name = 'alumno';
        $role->description = 'Alumno';
        $role->save();
        $role = new Role();
        $role->name = 'administrador';
        $role->description = 'Administrador';
        $role->save();
    }
}
