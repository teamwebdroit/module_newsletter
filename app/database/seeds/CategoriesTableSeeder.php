<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
            \Droit\Categorie\Entities\Categories::create([
                'pid'        => 195,
                'user_id'    => 1,
                'title'      => $data['title'],
                'image'      => $data['image'],
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s')
			]);
		}
	}

}