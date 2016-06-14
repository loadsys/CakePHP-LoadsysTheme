<?php
/**
 * Set up test environment.
 */

// @codingStandardsIgnoreFile

use Cake\Core\Plugin;

require_once 'vendor/autoload.php';

define('TMP', sys_get_temp_dir() . DS);

Plugin::load('Bake', [
	'path' => dirname(dirname(__FILE__)) . DS,
]);
