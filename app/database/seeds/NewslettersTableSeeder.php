<?php


class NewslettersTableSeeder extends Seeder {

	public function run()
	{
        // Uncomment the below to wipe the table clean before populating
        DB::table('newsletters')->truncate();

        $models = array(
            array(
                'titre'        => 'Droit du travail',
                'from_name'    => 'Droit du travail',
                'from_email'   => 'info@droitdutravail.ch',
                'return_email' => 'info@droitdutravail.ch',
                'unsuscribe'   => 'http://newsletter.local/unsuscribe',
                'preview'      => 'http://newsletter.local/preview',
                'logos'        => 'http://newsletter.local/newsletter/logos-droitravail.jpg',
                'header'       => 'http://newsletter.local/newsletter/header-droitravail.jpg'
            )
        );

        // Uncomment the below to run the seeder
        DB::table('newsletters')->insert($models);
	}

}