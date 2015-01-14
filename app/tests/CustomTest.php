<?php

class CustomTest extends TestCase {

    protected $custom;

    public function setUp()
    {
        parent::setUp();

        $this->custom = new \Custom;
    }

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testCompareArray()
	{
        $selected = array(4);
        $result   = array(1,2,3,4);

        $actual = $this->custom->compare($selected, $result);

        $this->assertTrue($actual);
	}

    /**
     * Get elements by prefix
     *
     * @return void
     */
    public function testGetElementWithPrefix()
    {
        $array  = array('year-1','year-3','year-2');
        $prefix = 'year-';

        $expected = array(1,3,2);
        $actual   = $this->custom->getPrefixString($array, $prefix);

        $this->assertEquals($expected,$actual);
    }

    /**
     * Prepare terms for search
     *
     * @return void
     */
    public function testPrepareSearchSimple()
    {
        $string  = 'df  fd';

        $expected = array('df','fd');
        $actual   = $this->custom->prepareSearch($string);

        $this->assertEquals($expected,$actual);
    }

    /**
     * Prepare terms for search
     *
     * @return void
     */
    public function testPrepareSearchQuotes()
    {
        $string  = '"df fd"';

        $expected = array('df fd');
        $actual   = $this->custom->prepareSearch($string);

        $this->assertEquals($expected,$actual);
    }

    /**
     * Prepare terms for search
     *
     * @return void
     */
    public function testPrepareSearchQuotesAndSimple()
    {
        $string  = '"TF 4A_549/2013" bail';

        $expected = array('TF 4A_549/2013','bail');
        $actual   = $this->custom->prepareSearch($string);

        $this->assertEquals($expected,$actual);
    }

    /**
     * Prepare terms for search
     *
     * @return void
     */
    public function testSanitizeUrlForImageInNewsletter()
    {
        $string   = 'www.deignpond.ch';
        $expected = 'http://www.deignpond.ch';
        $actual   = $this->custom->sanitizeUrl($string);

        $this->assertEquals($expected,$actual);
    }

    /**
     * Prepare categories for sync
     *
     * @return void
     */
    public function testPrepareCategorieForSync()
    {
        $string   = array(5,2,1);
        $expected = array(
            5 => ['sorting' => 0],
            2 => ['sorting' => 1],
            1 => ['sorting' => 2]
        );
        $actual = $this->custom->prepareCategories($string);

        $this->assertEquals($expected,$actual);
    }

}
