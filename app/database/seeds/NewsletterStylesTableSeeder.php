<?php


class NewsletterStylesTableSeeder extends Seeder {

	public function run()
	{
        // Uncomment the below to wipe the table clean before populating
        DB::table('newsletter_styles')->truncate();

        $newsletter_styles = array(
            array('styles' => 'font-family: Arial, Helvetica,sans-serif;font-size:15px;font-weight:bold;color:#cb2629;margin: 0 0 10px 0;padding: 0 0 0 0;','tag_name' => 'h2','newsletter_id' => '1'),
            array('styles' => 'font-family: Arial, Helvetica,sans-serif;font-size:13px;font-weight:bold;color:#cb2629;margin: 0 0 10px 0;padding: 0 0 0 0;','tag_name' => 'h3','newsletter_id' => '1'),
            array('styles' => 'text-align:justify;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight:normal;color:#303030;margin:0 0 10px 0;padding:0;','tag_name' => 'p','newsletter_id' => '1'),
            array('styles' => 'text-align:justify;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight:normal;font-style:italic;color:#666;margin:0 0 10px 0;padding:0 0 0 0;','tag_name' => 'h4','newsletter_id' => '1'),
            array('styles' => 'text-decoration:underline;text-align:justify;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight:normal;color:#303030;margin:0 0 10px 0;padding:0;','tag_name' => 'a','newsletter_id' => '1'),
            array('styles' => 'text-align:justify;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight:normal;color:#1c1c1b;margin-bottom:5px;','tag_name' => 'li','newsletter_id' => '1')
        );

        // Uncomment the below to run the seeder
        DB::table('newsletter_styles')->insert($newsletter_styles);
	}

}