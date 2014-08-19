<?php

use Cair\Platform\Database\DynamicModel;

class DynamicModelTest extends \PHPUnit_Framework_TestCase {

	function test_specifies_resource_and_adds_attributes()
	{
		$model = new DynamicModel('people', [
			'name' => 'basti'
		]);

		$this->assertEquals('people', $model->getResource());
		$this->assertEquals('basti', $model->name);
	}

	function test_can_set_attribute_via_property()
	{
		$model = new DynamicModel('people');

		$model->name = 'basti';

		$this->assertEquals('basti', $model->name);
	}

	function test_can_unset_and_check_set_via_property()
	{
		$model = new DynamicModel('people', [
			'name' => 'basti'
		]);

		$this->assertTrue(isset($model->name));

		unset($model->name);

		$this->assertFalse(isset($model->name));
	}

}