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

$ignoreFields = ['id', 'modified', 'creator_id', 'modifier_id'];

$fields = collection($fields)
	->filter(function($field) use ($schema) {
		return !in_array($schema->columnType($field), ['binary', 'text']);
	})
	->take(7);

echo $this->element('breadcrumbs');
%>
<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('New <%= $singularHumanName %>'), ['action' => 'add']) ?></li>
<%
	$done = [];
	foreach ($associations as $type => $data):
		foreach ($data as $alias => $details):
			if (!empty($details['navLink']) && $details['controller'] !== $this->name && !in_array($details['controller'], $done)):
%>
		<li><?= $this->Html->link(__('List <%= $this->_pluralHumanName($alias) %>'), ['controller' => '<%= $details['controller'] %>', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('New <%= $this->_singularHumanName($alias) %>'), ['controller' => '<%= $details['controller'] %>', 'action' => 'add']) ?></li>
<%
				$done[] = $details['controller'];
			endif;
		endforeach;
	endforeach;
%>
	</ul>
</div>
<div class="<%= $pluralVar %> index large-10 medium-9 columns">
	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
	<% foreach ($fields as $field):
		if (in_array($field, $ignoreFields)) { continue; } %>
		<th><?= $this->Paginator->sort('<%= $field %>') ?></th>
	<% endforeach; %>
		<th class="actions"><?= __('Actions') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($<%= $pluralVar %> as $<%= $singularVar %>): ?>
		<tr>
<%		foreach ($fields as $field) {
			if (in_array($field, $ignoreFields)) { continue; }
			$isKey = false;
			if (!empty($associations['BelongsTo'])) {
				foreach ($associations['BelongsTo'] as $alias => $details) {
					if ($field === $details['foreignKey']) {
						$isKey = true;
%>
			<td>
				<?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?>
			</td>
<%
						break;
					}
				}
			}
			if ($isKey !== true) {
				if ($field == 'created') {
%>
			<td>
				<?= $this->Html->tooltipCreateDate($<%= $singularVar %>-><%= $field %>, $<%= $singularVar %>->modified, $<%= $singularVar %>->has('modifier') ? $<%= $singularVar %>->modifier->full_name : '') ?>
			</td>
<%
				} elseif (
					in_array($schema->columnType($field), ['boolean'])
				) {
%>
			<td>
				<?= $this->Html->yesNo($<%= $singularVar %>-><%= $field %>) ?>
			</td>
<%
				} elseif (
					in_array($schema->columnType($field), ['date'])
				) {
%>
			<td>
				<?= $this->Html->niceShortDateOnly($<%= $singularVar %>-><%= $field %>) ?>
			</td>
<%
				} elseif (
					in_array($schema->columnType($field), ['datetime'])
				) {
%>
			<td>
				<?= $this->Html->niceShort($<%= $singularVar %>-><%= $field %>) ?>
			</td>
<%
				} elseif (
					!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])
				) {
%>
			<td>
				<?= h($<%= $singularVar %>-><%= $field %>) ?>
			</td>
<%
				} elseif (
					in_array($schema->columnType($field), ['decimal'])
				) {
%>
			<td>
				<?= $this->Number->currency($<%= $singularVar %>-><%= $field %>) ?>
			</td>
<%
				} else {
%>
			<td>
				<?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?>
			</td>
<%
				}
			}
		}

		$pk = '$' . $singularVar . '->' . $primaryKey[0];
		$display = '$' . $singularVar . '->' . $displayField;
%>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['action' => 'view', <%= $pk %>]) ?>
				<?= $this->Html->link(__('Edit'), ['action' => 'edit', <%= $pk %>]) ?>
				<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', <%= $pk %>], ['confirm' => __('Are you sure you want to delete # {0}?', <%= $display %>)]) ?>
			</td>
		</tr>

	<?php endforeach; ?>
	</tbody>
	</table>
	<div class="paginator">
		<ul class="pagination">
			<?= $this->Paginator->prev('< ' . __('previous')) ?>
			<?= $this->Paginator->numbers() ?>
			<?= $this->Paginator->next(__('next') . ' >') ?>
		</ul>
		<p><?= $this->Paginator->counter() ?></p>
	</div>
</div>
