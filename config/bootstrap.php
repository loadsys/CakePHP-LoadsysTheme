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
 * Install our own BakeHelper.
 */
EventManager::instance()->on('Bake.initialize', function (Event $event) {
	$view = $event->subject;

	// Load our overridden BakeHelper class.
	$view->loadHelper('LoadsysTheme.Bake', []);
});

/**
 * Change viewVars globally.
 */
// EventManager::instance()->on('Bake.beforeRender', function (Event $event) {
//     $view = $event->subject;
//
//     // Use $rows for the main data variable in indexes
//     if ($view->get('pluralName')) {
//         $view->set('pluralName', 'rows');
//     }
//     if ($view->get('pluralVar')) {
//         $view->set('pluralVar', 'rows');
//     }
//
//     // Use $theOne for the main data variable in view/edit
//     if ($view->get('singularName')) {
//         $view->set('singularName', 'theOne');
//     }
//     if ($view->get('singularVar')) {
//         $view->set('singularVar', 'theOne');
//     }
// });

//
/**
 * Example of injecting viewVars for a specific generated file:
 */
// EventManager::instance()->on(
//     'Bake.beforeRender.Controller.controller',
//     function (Event $event) {
//         $view = $event->subject();
//         if ($view->viewVars['name'] == 'Users') {
//             // add the login and logout actions to the Users controller
//             $view->viewVars['actions'] = [
//                 'login',
//                 'logout',
//                 'index',
//                 'view',
//                 'add',
//                 'edit',
//                 'delete'
//             ];
//         }
//     }
// );
