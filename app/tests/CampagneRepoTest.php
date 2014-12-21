<?php

class CampagneRepoTest extends TestCase {

    protected $custom;

    public function setUp()
    {
        parent::setUp();

        //$this->mock = $this->mock('Droit\Newsletter\Repo\NewsletterCampagneInterface');
    }

    public function mock($class)
    {
        $mock = Mockery::mock($class);

        $this->app->instance($class, $mock);

        return $mock;
    }

    /**
     * Admin Index arret page
     *
     * @return void
     */
    public function testCampagneAdmin()
    {

        $this->client->request('GET', 'admin/campagne');
        $this->assertViewHas('campagnes');

    }

    /**
     * Admin show arret page
     *
     * @return void
     */
/*    public function testAdminShowArretPage()
    {
        $this->client->request('GET', 'admin/arret/819');

        $this->assertViewHas('arret');
        $this->assertViewHas('categories');
    }*/

    public function tearDown()
    {
        \Mockery::close();
    }

}
