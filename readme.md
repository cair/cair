## Cair Platform

This package providies you with three components to manage the content on your website:

* Platform: A dynamic active record implementation. Allowing you to configure your data structure at runtime.
* Access: A restful JSON API used by the admin panel or by your application.
* Panel: The admin panel for filling in your data.

# Installation

Via composer.

``` json
{
    "require": {
        "cair/cair": "0.1.*",
        "stack/builder": "1.0.*",
        "stack/url-map": "1.0.*"
    }
}
```

`composer update`

And bower.

`bower install cair-panel`

# Usage


```php
// Create your application in $app.

Cair\Platform\Provider::setConfig([
  'resources' => [
		'posts' => [
			'attributes' => ['title', 'content'],
			'rules' => [
				'title' => ['required', 'min' => 3],
				'content' => ['required']
			],
			'types' => [
				'title' => 'text',
				'content' => 'textarea',
			]
		]
	],
	'scripts' => [
		"panel/dist/js/cair.js"
	]
]);

$stack = new Stack\Builder;

$stack->push('Stack\UrlMap', [
    '/admin' => require(__DIR__.'/src/Cair/Panel/start.php'),
    '/api' => require(__DIR__.'/src/Cair/Access/start.php'),
]);

$app = $stack->resolve($app);

$request = Request::createFromGlobals();

$app->handle($request)->send();
```
