<?php

class InscriptionControllerTest extends TestCase {

    protected $custom;

    public function setUp()
    {
        parent::setUp();

        //$this->mock = $this->mock('Droit\Newsletter\Repo\NewsletterUserInterface');
    }

    public function mock($class)
    {
        $mock = Mockery::mock($class);

        $this->app->instance($class, $mock);

        return $mock;
    }

    /**
     * Jurisprudence page
     *
     * @return void
     */
    public function testInscriptionPage()
    {
        $this->client->request('GET', 'admin/dashboard');

    }


    public function tearDown()
    {
        \Mockery::close();
    }

}
