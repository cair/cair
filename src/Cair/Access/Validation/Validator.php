<?php

namespace Cair\Access\Validation;

use Cair\Platform\Database\DynamicModel;

class Validator {

	protected $attributes;

	protected $rules;

	protected $failed;

	public function __construct($attributes, $rules)
	{
		$this->attributes = $attributes;

		$this->rules = $rules;
	}

	public function passes()
	{
		foreach ($this->attributes as $attribute => $value)
		{
			foreach ($this->rules[$attribute] as $rule => $parameters)
			{
				// If parameters are provided, if not the rule name is stored as
				// the value not the key.
				if ( ! is_array($parameters))
				{
					$rule = $parameters;

					$parameters = [];
				}

				$method = 'validate' . ucfirst($rule);

				$parameters[] = $value;

				if( ! $succeded = call_user_func_array([$this, $method], $parameters))
				{
					$this->failed[] = $attribute;
				}
			}
		}

		return empty($this->failed);
	}

	public function validateRequired($value)
	{
		if (is_null($value))
		{
			return false;
		}
		elseif (is_string($value) && trim($value) === '')
		{
			return false;
		}
		
		return true;
	}

	public function validateMin($value, $min)
	{
		return strlen($value) >= $min;
	}

	public function getAttributes()
	{
		return $this->attributes;
	}

	public function setAttributes($attributes)
	{
		$this->attributes = $attributes;

		return $this;
	}

	public function getRules()
	{
		return $this->rules;
	}

	public function setRules($rules)
	{
		$this->rules = $rules;

		return $this;
	}

	public function getFailed()
	{
		return $this->failed;
	}

	public function setFailed($failed)
	{
		$this->failed = $failed;

		return $this;
	}

}