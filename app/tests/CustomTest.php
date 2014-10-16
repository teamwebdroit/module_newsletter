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

}
