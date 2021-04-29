<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    
    public function run() {
        DB::table('users')->insert([
            'name' => 'Valentin',
            'last_name' => 'Ortiz',
            'about_me' => 'Ingeniero en Electrónica',
            'role' => 'user',
            'email' => 'ortizsantiago9303@gmail.com',
            'password' => Hash::make('admin00#$'),
            'nick' => 'Val93',
        ]);
    }
}
