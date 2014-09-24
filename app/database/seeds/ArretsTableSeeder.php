<?php


class ArretsTableSeeder extends Seeder {

	public function run()
	{
        // Uncomment the below to wipe the table clean before populating
        DB::table('arrets')->truncate();

        $models = array(
            array(
                'titre'        => 'Séminaire sur le droit du bail',
                'from_name'    => 'Séminaire sur le droit du bail',
                'from_email'   => 'info@bail.ch',
                'return_email' => 'info@bail.ch',
                'unsuscribe'   => 'http://newsletter.local/unsuscribe',
                'preview'      => 'http://newsletter.local/preview',
                'logos'        => 'http://newsletter.local/newsletter/logos-bail.jpg',
                'header'       => 'http://newsletter.local/newsletter/header-bail.jpg'
            )
        );

        // Uncomment the below to run the seeder
        DB::table('arrets')->insert($models);
	}

}