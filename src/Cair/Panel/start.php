<?php

return call_user_func(function()
{
	$app = new Silex\Application();

	$app->get('/', function()
	{
		$config = Cair\Platform\Provider::getConfig();

	    $scripts = is_array($config['scripts']) ? $config['scripts'] : [$config['scripts']];
	    
	    ob_start();

	    include(__DIR__.'/panel.php');

	    $content = ob_get_contents();

	    ob_end_clean();

	    return $content;
	});

	return $app;
});
