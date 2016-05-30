<?php


class NewsletterTypesTableSeeder extends Seeder {

	public function run()
	{
        // Uncomment the below to wipe the table clean before populating
        DB::table('newsletter_types')->truncate();

        $newsletter_types = array(
            array(
                'titre'     => 'Image',
                'image'     => 'image.svg',
                'partial'   => 'image',
                'template'  => 'image',
                'elements'  => 'image'
            ),
            array(
                'titre'     => 'Text',
                'image'     => 'text.svg',
                'partial'   => 'text',
                'template'  => 'text',
                'elements'  => 'text'
            ),
            array(
                'titre'     => 'Text et image',
                'image'     => 'imageText.svg',
                'partial'   => 'imageText',
                'template'  => 'image-text',
                'elements'  => 'titre,texte,image'
            ),
            array(
                'titre'     => 'Text et image à droite',
                'image'     => 'imageRightText.svg',
                'partial'   => 'imageRightText',
                'template'  => 'image-right-text',
                'elements'  => 'titre,texte,image'
            ),
            array(
                'titre'     => 'Text et image à gauche',
                'image'     => 'imageLeftText.svg',
                'partial'   => 'imageLeftText',
                'template'  => 'image-left-text',
                'elements'  => 'titre,texte,image'
            ),
            array(
                'titre'     => 'Arrêt',
                'image'     => 'arret.svg',
                'partial'   => 'arret',
                'template'  => 'arret',
                'elements'  => 'arret'
            )
        );

        // Uncomment the below to run the seeder
        DB::table('newsletter_types')->insert($newsletter_types);

	}

}