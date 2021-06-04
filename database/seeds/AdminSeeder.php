<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'nama' => 'Bunbun',
            'username' => 'powerplay',
            'password' => Hash::make('powerplay2020')
        ]);
    }
}
