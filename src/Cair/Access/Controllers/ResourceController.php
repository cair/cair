<?php

namespace Cair\Access\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Silex\Application;
use Cair\Platform\Provider;
use Cair\Access\Validation\Validator;

class ResourceController {

	public function index(Application $app, $resource)
	{
		$provider = $app['provider'];

	    $records = $provider->in($resource)->get();

	    foreach ($records as $key => $value)
	    {
	        $records[$key] = $value->toArray();
	    }

	    return new JsonResponse([
	        $resource => $records
	    ]);
	}

	public function find(Application $app, $resource, $id)
	{
		$provider = $app['provider'];

	    $record = $provider->in($resource)->find($id);

	    return new JsonResponse([
	        $resource => $record->toArray()
	    ]);
	}

	public function store(Request $request, Application $app, $resource)
	{
		$provider = $app['provider'];

		$config = Provider::getConfig()['resources'];

	    $input = json_decode($request->getContent(), true);

	    $input = array_intersect_key($input, array_flip($config[$resource]['attributes']));

	    $validator = new Validator($input, $config[$resource]['rules']);

	    if ($validator->passes())
	    {
	    	$record = $provider->in($resource)->create($input);

		    return new JsonResponse([
		        $resource => $record->toArray()
		    ]);
	    }
	    
	    return new JsonResponse([]);
	}

	public function update(Request $request, Application $app, $resource, $id)
	{
		$provider = $app['provider'];

		$config = Provider::getConfig()['resources'];

	    $input = json_decode($request->getContent(), true);

	    $input = array_intersect_key($input, array_flip($config[$resource]['attributes']));

	    $record = $provider->in($resource)->find($id)->update($input);

	    return new JsonResponse([
	        $resource => $record->toArray(),
	    ]);
	}

	public function delete(Application $app, $resource, $id)
	{
		$provider = $app['provider'];

	    $provider->in($resource)->find($id)->delete();

	    return new JsonResponse([]);
	}
}