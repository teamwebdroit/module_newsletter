<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		$this->call('NewslettersTableSeeder');
        $this->call('NewsletterCampagnesTableSeeder');
        $this->call('NewsletterStylesTableSeeder');
        $this->call('NewsletterTypesTableSeeder');
        $this->call('AnalysesArretTableSeeder');
        $this->call('ArretBaCategoriesTableSeeder');
        $this->call('AnalyseBaCategoriesTableSeeder');
	}

}
