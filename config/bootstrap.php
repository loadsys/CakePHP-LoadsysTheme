<?php
/**
 * Hook into the normal baking process to install our own Helper(s) and
 * modify the view Vars used for any generated file.
 *
 * @link http://book.cakephp.org/3.0/en/bake/development.html
 */

use Cake\Event\Event;
use Cake\Event\EventManager;

/**
 * Default to the LoadsysTheme and install our own BakeHelper.
 */
EventManager::instance()->on('Bake.initialize', function (Event $event) {
	$view = $event->subject;

	// Use the LoadsysTheme if none was explicitly named.
	if (empty($view->theme())) {
		$view->theme('LoadsysTheme');
	}

	// Swap in our overridden BakeHelper class.
	$view->helpers()->unload('Bake');
	$view->loadHelper('LoadsysTheme.Bake');
});
