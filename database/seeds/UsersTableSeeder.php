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
        User::create([
            'name' => 'Ewaldo',
            'email' => 'admin@kasa.id',
            'phone' => '089696969696',
            'role_id' => 1,
            'password' => bcrypt('secret'),
            'status' => true
        ]);
    }
}
