<%
/**
 * Breadcrumbs for use with basic CRUD templates
 *
 * If there are additional or custom templates, the switch cases
 * and/or the keyedActions array might need modifications to
 * support the conditionals for these new templates
 */

use Cake\Utility\Inflector;

$pk = "\$$singularVar->{$primaryKey[0]}";
$display = "\$$singularVar->{$displayField}";
$keyedActions = ['view', 'edit'];

switch ($action) {
   case 'view':
      $lastCrumb = "h({$display})";
      break;
   default:
      $humanAction = Inflector::humanize($action);
      $lastCrumb = "__('{$humanAction} {$singularHumanName}')";
      break;
}
%>
<?php
$this->set('breadcrumbs', [
  __('<%= $pluralHumanName %>') => [
	 'prefix' => $this->request->params['prefix'],
	 'controller' => '<%= Inflector::camelize($pluralVar) %>',
	 'action' => 'index',
  ],
<% if ($action != "index"): %>
  <%= $lastCrumb %> => [
	 'prefix' => $this->request->params['prefix'],
	 'controller' => '<%= Inflector::camelize($pluralVar) %>',
	 'action' => '<%= $action %>',
<%= (in_array($action, $keyedActions) ? "\t\t{$pk},\n" : '') %>    ],
<% endif; %>
]);
?>
