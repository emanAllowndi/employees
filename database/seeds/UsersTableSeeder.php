<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user=  \App\Model\user::create([
        'first_name'     => 'eman',
        'middel_name'     => 'mohammed',
        'last_name'     => 'lowndi',
        'email'    => 'eman@test.com',
        'password' => bcrypt('123456'),

    
        ]);

        $user->attachRole('super_admin');
    }
}
