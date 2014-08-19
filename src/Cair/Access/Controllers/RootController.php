<?php

namespace Cair\Access\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Cair\Platform\Provider;

class RootController {

	public function index()
	{
		$config = Provider::getConfig();

		return new JsonResponse([
	        'resources' => $config['resources']
	    ]);
	}
}