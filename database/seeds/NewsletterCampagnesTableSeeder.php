<?php


class NewsletterCampagnesTableSeeder extends Seeder {

	public function run()
	{
        // Uncomment the below to wipe the table clean before populating
        DB::table('newsletter_campagnes')->truncate();

        $newsletter_campagnes = array(
            array(
                'sujet'         => 'Newsletter - Août 2014',
                'auteurs'       => 'Editée par Bohnet F., Broquet J., Carron B., Montini M.',
                'newsletter_id' => '1',
                'created_at'    => date('Y-m-d G:i:s'),
                'updated_at'    => date('Y-m-d G:i:s')
            )
        );

        // Uncomment the below to run the seeder
        DB::table('newsletter_campagnes')->insert($newsletter_campagnes);
	}

}