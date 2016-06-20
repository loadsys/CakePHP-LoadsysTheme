<% foreach ($constraints as $table => $tableConstraints):
	echo $this->element('LoadsysTheme.add-foreign-keys', ['constraints' => $tableConstraints, 'table' => $table]);
endforeach; %>
