<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{

        DB::table('users')->delete();

        \Droit\User\Entities\User::create(array(
            'prenom'   => 'Cindy',
            'nom'      => 'Leschaud',
            'email'    => 'cindy.leschaud@gmail.com',
            'password' => Hash::make('droitdutravail')
        ));

        \Droit\User\Entities\User::create(array(
            'prenom'   => 'Sylvia',
            'nom'      => 'Staehli',
            'email'    => 'sylvia.staehli@unine.ch',
            'password' => Hash::make('droitdutravail')
        ));

    }

}