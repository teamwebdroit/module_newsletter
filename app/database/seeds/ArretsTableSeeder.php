<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ArretsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 30) as $index)
		{
            $categories = array();

            $count = $faker->numberBetween(1, 3);

            for($i = 0; $i <= $count; $i++){
                $categories[] = $faker->numberBetween(62, 92);
            }

            $cour = $faker->randomElement(array('A','C','E'));
            $num  = $faker->randomDigit();
            $rand = $faker->randomNumber(3);
            $year = $faker->randomElement(array('2012','2013','2014'));

            $ref  = $cour.''.$num.'_'.$rand.'/'.$year;

            $text  = '<p>'.$faker->text(900).'</p>';
            $text .= '<p>'.$faker->text(300).'</p>';
            $text .= '<p>'.$faker->text(1440).'</p>';

            $arret = \Droit\Content\Entities\Arret::create([
                'pid'        => 195,
                'user_id'    => 1,
                'reference'  => $ref,
                'pub_date'   => $faker->dateTimeBetween('-3 years', 'now'),
                'abstract'   => $faker->text(250),
                'pub_text'   => $text,
                'categories' => count($categories),
                'file'       => 'Fichier_test.pdf',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s')
			]);

            $arret->arrets_categories()->sync($categories);

		}
	}

}