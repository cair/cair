<?php

return call_user_func(function()
{
	$app = new Silex\Application();

	$app['provider'] = new Cair\Platform\Provider;

	$app->get('/', 'Cair\Access\Controllers\RootController::index');

	$app->get('/{resource}', 'Cair\Access\Controllers\ResourceController::index');

	$app->get('/{resource}/{id}', 'Cair\Access\Controllers\ResourceController::find');

	$app->post('/{resource}', 'Cair\Access\Controllers\ResourceController::store');

	$app->put('/{resource}/{id}', 'Cair\Access\Controllers\ResourceController::update');

	$app->delete('/{resource}/{id}', 'Cair\Access\Controllers\ResourceController::delete');

	return $app;
});