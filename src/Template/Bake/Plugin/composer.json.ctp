<%
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
%>
{
	"name": "loadsys/<%= $plugin %>",
	"description": "<%= $plugin %> plugin for CakePHP",
	"type": "cakephp-plugin",
	"keywords": ["cakephp", "plugin"],
	"homepage": "https://github.com/loadsys/<%= $plugin %>",
	"license": "MIT",
	"support": {
		"issues": "https://github.com/loadsys/<%= $plugin %>/issues",
		"source": "https://github.com/loadsys/<%= $plugin %>"
	},
	"require": {
		"php": ">=5.4.16",
		"cakephp/cakephp": "~3.0"
	},
	"require-dev": {
		"phpunit/phpunit": "~4.1",
		"loadsys/loadsys_codesniffer": "~3.0",
	},
	"autoload": {
		"psr-4": {
			"<%= $plugin %>\\": "src"
		}
	},
	"autoload-dev": {
		"psr-4": {
			"<%= $plugin %>\\Test\\": "tests",
			"Cake\\Test\\": "./vendor/cakephp/cakephp/tests"
		}
	}
}
