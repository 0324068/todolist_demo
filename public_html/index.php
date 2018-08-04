<?php include('header.php')?>
<?php include('data.php')?>    
	<div id="panel">
	<h1>todo list</h1>
	<div id="todolist">
		<ul>
			
			<li class="new">
				<div class="checkbox"></div>
				<div class="content"></div>
				</div>
			</li>
		</ul>
	</div>	
	
	
	<script id="todotemp" type="text/x-handlebars-template">
		<li data-id = "{{id}}" class="{{#if iscomplete}}complete{{/if}}">
			<div class="checkbox"></div>
			<div class="content">{{content}}</div>
			<div class="action">
			<div class="del">x</div>
			</div>
		</li>
	</script>
<?php include('footer.php')?>