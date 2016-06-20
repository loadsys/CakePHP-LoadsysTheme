<% foreach ($indexes as $indexName => $index): %>
			->addIndex([<% echo $this->Migration->stringifyList($index['columns'], ['indent' => false]); %>], [<%
				$params = ['name' => $indexName];
				if ($index['type'] === 'unique'):
					$params['unique'] = true;
				endif;
				echo $this->Migration->stringifyList($params, ['indent' => 4]);
			%>])
<% endforeach; %>
