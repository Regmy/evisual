<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'nombre' => 'Admin',
            'documento' => '999999',
            'contrasena' => Hash::make('secret'),
            'rol' => 'Admin',
            'sede' => 'Admin',
            'nivelacceso' => 'Administrador',
            'email' => 'evadmin@pevisual.com',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
