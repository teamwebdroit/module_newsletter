<?php

class HomeControllerTest extends TestCase
{

    protected $custom;

    public function setUp()
    {
        parent::setUp();
        $this->mock = $this->mock('Droit\Newsletter\Repo\NewsletterUserInterface');
    }

    public function mock($class)
    {
        $mock = Mockery::mock($class);

        $this->app->instance($class, $mock);

        return $mock;
    }

    /**
     * Home page
     *
     * @return void
     */
    public function testHomePage()
    {
        $this->client->request('GET', '/');
    }

    /**
     * Jurisprudence page
     *
     * @return void
     */
    public function testJurisprudencePage()
    {
        $this->client->request('GET', 'jurisprudence');

        $this->assertViewHas('arrets');
        $this->assertViewHas('analyses');
        $this->assertViewHas('annees');
    }

    /**
     * Newsletter page
     *
     * @return void
     */
    public function testNewsletterPage()
    {
        $this->client->request('GET', 'newsletters');

        $this->assertViewHas('listCampagnes');
    }

    /**
     * Colloque page
     *
     * @return void
     */
    public function testColloquePage()
    {
        $this->client->request('GET', 'colloque');

    }

    /**
     * Contact page
     *
     * @return void
     */
    public function testContactPage()
    {
        $this->client->request('GET', 'contact');

    }

    public function tearDown()
    {
        \Mockery::close();
    }
}
