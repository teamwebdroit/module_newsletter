<?php

class Subscribe extends TestCase
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
     * A basic functional test example.
     *
     * @return void
     */
    public function testSubscribeEmailDoesExist()
    {
        $email = 'cindy.leschaud@gmail.com';
/*
        $this->mock->shouldReceive('create')->once();

        $this->call('POST', 'inscription', array('email' => $email));

        $this->assertRedirectedTo('/', array('status' => 'danger' ));*/
    }

    public function tearDown()
    {
        \Mockery::close();
    }
}
