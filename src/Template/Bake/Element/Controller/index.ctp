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

	/**
	 * Paginate through multiple <%= $pluralName %> records.
	 *
	 * @return void
	 */
	public function index() {
<% $belongsTo = $this->Bake->aliasExtractor($modelObj, 'BelongsTo'); %>
<% if ($belongsTo):
	$belongsTo = array_diff($belongsTo, $ignoreAssociations); %>
		$this->paginate = [
			'contain' => [<%= $this->Bake->stringifyList($belongsTo, ['indent' => false]) %>],
		];
<% endif; %>
		$this->set('<%= $pluralName %>', $this->paginate($this-><%= $currentModelName %>));
		$this->set('_serialize', ['<%= $pluralName %>']);
	}
