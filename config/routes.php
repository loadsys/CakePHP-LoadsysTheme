<?php
use Cake\Routing\Router;

Router::plugin('LoadsysTheme', function ($routes) {
	$routes->fallbacks('InflectedRoute');
});
