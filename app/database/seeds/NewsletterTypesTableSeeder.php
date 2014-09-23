<?php


class NewsletterTypesTableSeeder extends Seeder {

	public function run()
	{
        // Uncomment the below to wipe the table clean before populating
        DB::table('newsletter_types')->truncate();

        $newsletter_types = array(
            array(
                'titre'     => 'Image',
                'partial'   => 'imageCenter',
                'template'  => 'image',
                'elements'  => 'image'
            ),
            array(
                'titre'     => 'Text et image',
                'partial'   => 'imageText.',
                'template'  => 'image-text',
                'elements'  => 'texte,image'
            ),
            array(
                'titre'     => 'Text et image à droite',
                'partial'   => 'ImageRightText',
                'template'  => 'image-right-text',
                'elements'  => 'titre,texte,image'
            ),
            array(
                'titre'     => 'Text et image à gauche',
                'partial'   => 'ImageLeftText',
                'template'  => 'image-left-text',
                'elements'  => 'titre,texte,image'
            ),
            array(
                'titre'     => 'Arrêt',
                'partial'   => 'arretImageText.',
                'template'  => 'arret',
                'elements'  => 'arret'
            )
        );

        // Uncomment the below to run the seeder
        DB::table('newsletter_types')->insert($newsletter_types);

	}

}