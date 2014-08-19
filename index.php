<?php

require 'vendor/autoload.php';

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application;

$app->get('/', function()
{
    return 'Hello World';
});

$config = [
	'resources' => [
		'posts' => [
			'attributes' => ['title', 'content'],
			'rules' => [
				'title' => ['required', 'min' => [3]],
				'content' => ['required']
			],
			'types' => [
				'title' => 'text',
				'content' => 'textarea',
			]
		]
	],
	'scripts' => [
		"panel/dist/js/cair.js",
		"config.js"
	]
];

Cair\Platform\Provider::setConfig($config);

$panel = require(__DIR__.'/src/Cair/Panel/start.php');

$api = require(__DIR__.'/src/Cair/Access/start.php');

$stack = new Stack\Builder;

$stack->push('Stack\UrlMap', [
    '/admin' => $panel,
    '/api' => $api,
]);

$app = $stack->resolve($app);

$request = Request::createFromGlobals();

$app->handle($request)->send();