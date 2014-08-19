<?php

use Cair\Config\JsonEngine;

class JsonEngineTest extends \PHPUnit_Framework_TestCase {

	protected $engine;

	public function setUp()
	{
		$this->engine = new JsonEngine;
	}

	function test_it_compiles_json_into_array()
	{
		$result = $this->engine->compile('{"foo" : "bar"}');

		$this->assertTrue(is_array($result), 'The compiler should return an array.');
		$this->assertEquals('bar', $result['foo']);
	}

	function test_it_compiles_pipes_into_arrays()
	{
		$result = $this->engine->compile('{"foo" : "bar|baz"}');

		$this->assertEquals($result['foo'][0], 'bar');
	}

	function test_it_compiles_colons()
	{
		$result = $this->engine->compile('{"foo" : "bar:baz"}');

		$this->assertEquals($result['foo'], ['bar' => 'baz']);
	}

	function test_it_compiles_nested_structures()
	{
		$result = $this->engine->compile('{"foo" : "bar:baz|fizz"}');

		$this->assertEquals(['bar' => ['baz', 'fizz']], $result['foo']);
	}

}