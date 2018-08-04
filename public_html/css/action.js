$(document).ready(function(){
	
	var source   = $('#todotemp').html();
	var template = Handlebars.compile(source);
	var todosui = "";
	$.each(todos,function(index,todo){
        todosui = todosui + template(todo);
	});
	$('#todolist').find('li.new').before(todosui);
	$('#todolist')	
	.on('dblclick','.content',function(e){
		$(this).prop('contenteditable',true).focus();
	})
	.on('blur','.content',function(e){
		var isnew =$(this).closest('li').is('.new');
		if(isnew){
		var todo =  $(e.currentTarget).text();
		if(todo.trim().length>0){
		var order = $('#todolist').find('li:not(.new)').length+1 ;
		$.post('todo/creat.php',{content:todo,order:order},
			function (data, textStatus, jqXHR) {
				todo={
					id:data.id,
					iscomplete:false,
					content:todo,
				};
				
				var li    = template(todo);
				$(e.currentTarget).closest('li').before(li);							
						
			})
		$(this).empty();
		}}
		
		else{
		var id= $(this).closest('li').data('id');	
		var content=$(this).text();
		$.post('todo/update.php',{id:id,content:content});	
		$(this).prop('contenteditable',false);
		}
	})
	.on('click','.checkbox',function(e){
		var id= $(this).closest('li').data('id');
		$.post('todo/complete.php',{id:id},function (data, textStatus, jqXHR) {
			$(e.currentTarget).closest('li').toggleClass('complete');
		})
					
	})
	.on('click','.content',function(e){
		if($(this).closest('li').is('.new')){
		$(this).prop('contenteditable',true).focus();}			
	})
	.on('click','.del',function(e){		
		var id= $(this).closest('li').data('id');
		$.post('todo/delete.php',{id:id});
		$(this).closest('li').remove();	
	})
	$('#todolist').find('ul').sortable({
	  items: "li:not(.new)",
	  stop: function(){
		var orderpair = [];
		$('#todolist').find('li:not(.new)').each(function (index,li) {
			orderpair.push({
			
			id:$(li).data('id'),
			order : index +1,
		});					
	  });
	  $.post('todo/sort.php',{orderpair:orderpair});
	  }
    })
});
   