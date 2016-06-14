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
use Cake\Utility\Inflector;

// List of Behaviors assumed to be provided by the parent [App]Table.
$appTableBehaviors = [
	'Timestamp',
	'CreatorModifier.CreatorModifier',
];

// List of Model associations assumed to be provided by the parent [App]Table.
$appTableAssociations = [
	'Creators',
	'Modifiers',
];

// List of [field => rule] validations assumed to be provided by the parent [App]Table.
$appTableValidations = [
	'id' => 'uuid',
	'created' => 'date',
	'creator_id' => 'uuid',
	'modified' => 'date',
	'modifier_id' => 'uuid',
];
%>
<?php
namespace <%= $namespace %>\Model\Table;

<%
$uses = [
	"use $namespace\\Model\\Entity\\$entity;",
	"use $namespace\\Model\\Table\\Table;",
	'use Cake\ORM\Query;',
	'use Cake\ORM\RulesChecker;',
	'use Cake\Validation\Validator;'
];
sort($uses);
echo implode("\n", $uses);
%>


/**
 * <%= $name %> Model
<% if ($associations): %>
 *
<% foreach ($associations as $type => $assocs): %>
<% foreach ($assocs as $assoc): %>
 * @property \Cake\ORM\Association\<%= Inflector::camelize($type) %> $<%= $assoc['alias'] %>
<% endforeach %>
<% endforeach; %>
<% endif; %>
 */
class <%= $name %>Table extends Table {

	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config) {
		parent::initialize($config);

<% if (!empty($table)): %>
		$this->table('<%= $table %>');
<% endif %>
<% if (!empty($displayField)): %>
		$this->displayField('<%= $displayField %>');
<% endif %>
<% if (!empty($primaryKey)): %>
<% if (count($primaryKey) > 1): %>
		$this->primaryKey([<%= $this->Bake->stringifyList((array)$primaryKey, ['indent' => false]) %>]);
<% elseif (current((array)$primaryKey) !== 'id'): %>
		$this->primaryKey('<%= current((array)$primaryKey) %>');
<% endif %>
<% endif %>

<% foreach ($behaviors as $behavior => $behaviorData):
	if (in_array($behavior, $appTableBehaviors)) { continue; } %>
		$this->addBehavior('<%= $behavior %>'<%= $behaviorData ? ", [" . implode(', ', $behaviorData) . ']' : '' %>);
<% endforeach %>
<% foreach ($associations as $type => $assocs): %>
<% foreach ($assocs as $assoc):
	if (in_array($assoc['alias'], $appTableAssociations)) { continue; }
	$alias = $assoc['alias'];
	unset($assoc['alias']);
%>
		$this-><%= $type %>('<%= $alias %>', [<%= $this->Bake->stringifyList($assoc, ['indent' => 3]) %>]);
<% endforeach %>
<% endforeach %>
	}
<% if (!empty($validation)): %>

	/**
	 * Default validation rules.
	 *
	 * @param \Cake\Validation\Validator $validator Validator instance.
	 * @return \Cake\Validation\Validator
	 */
	public function validationDefault(Validator $validator) {
		$validator = parent::validationDefault($validator);

		$validator
<%
$validationMethods = [];
$firstField = true;
foreach ($validation as $field => $rules):
	if (array_key_exists($field, $appTableValidations)) { continue; }

	if ($firstField !== true):
		$validationMethods[] = "\n\t\t\$validator";
	endif;

	foreach ($rules as $ruleName => $rule):

		if ($rule['rule'] && !isset($rule['provider'])):
			$validationMethods[] = sprintf(
				"->add('%s', '%s', ['rule' => '%s'])",
				$field,
				$ruleName,
				$rule['rule']
			);
		elseif ($rule['rule'] && isset($rule['provider'])):
			$validationMethods[] = sprintf(
				"->add('%s', '%s', ['rule' => '%s', 'provider' => '%s'])",
				$field,
				$ruleName,
				$rule['rule'],
				$rule['provider']
			);
		endif;

		if (isset($rule['allowEmpty'])):
			if (is_string($rule['allowEmpty'])):
				$validationMethods[] = sprintf(
					"->allowEmpty('%s', '%s')",
					$field,
					$rule['allowEmpty']
				);
			elseif ($rule['allowEmpty']):
				$validationMethods[] = sprintf(
					"->allowEmpty('%s')",
					$field
				);
			else:
				$validationMethods[] = sprintf(
					"->requirePresence('%s', 'create')",
					$field
				);
				$validationMethods[] = sprintf(
					"->notEmpty('%s')",
					$field
				);
			endif;
		endif;
	endforeach;
	$firstField = false;
	$validationMethods[] = array_pop($validationMethods) . ";";
endforeach;
%>
<%= "\t\t\t" . preg_replace(
	"|^\t\t\t$|m",
	'',
	implode("\n\t\t\t", $validationMethods)
) %>


		return $validator;
	}
<% endif %>
<% if (!empty($rulesChecker)): %>

	/**
	 * Returns a rules checker object that will be used for validating
	 * application integrity.
	 *
	 * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
	 * @return \Cake\ORM\RulesChecker
	 */
	public function buildRules(RulesChecker $rules) {
		$rules = parent::buildRules($rules);

	<%- foreach ($rulesChecker as $field => $rule):
		if (array_key_exists($field, $appTableValidations)) { continue; } %>
		$rules->add($rules-><%= $rule['name'] %>(['<%= $field %>']<%= !empty($rule['extra']) ? ", '$rule[extra]'" : '' %>));
	<%- endforeach; %>

		return $rules;
	}
<% endif; %>
<% if ($connection !== 'default'): %>

	/**
	 * Returns the database connection name to use by default.
	 *
	 * @return string
	 */
	public static function defaultConnectionName() {
		return '<%= $connection %>';
	}
<% endif; %>
}
