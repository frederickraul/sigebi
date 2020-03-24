<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	$role_alumno = Role::where('name', 'alumno')->first();
        $role_docente = Role::where('name', 'docente')->first();

        $user = new User();
        $user->name = 'Jose';
        $user->numero = '123';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_alumno);
        $user = new User();
        $user->name = 'Pancho';
        $user->numero = '456';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_alumno);
    }
}
