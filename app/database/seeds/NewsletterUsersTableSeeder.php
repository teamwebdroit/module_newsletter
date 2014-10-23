<?php

use Faker\Factory as Faker;

class NewsletterUsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 20) as $index)
		{
            Droit\Newsletter\Entities\Newsletter_users::create([
                'email'  => $faker->email,
                'prenom' => $faker->firstName,
                'nom'    => $faker->lastName
			]);
		}
	}

}