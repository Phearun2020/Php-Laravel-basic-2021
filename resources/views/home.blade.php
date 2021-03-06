<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{{ $title }}</title>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<style>
		body{
		background-color:#EEEEEE;
		}
		.todolist{
		background-color:#FFF;
		padding:20px 20px 10px 20px;
		margin-top:30px;
		}
		.todolist h1{
		margin:0;
		padding-bottom:20px;
		text-align:center;
		}
		.form-control{
		border-radius:0;
		}
		li.ui-state-default{
		background:#fff;
		border:none;
		border-bottom:1px solid #ddd;
		}

		li.ui-state-default:last-child{
		border-bottom:none;
		}

		.todo-footer{
		background-color:#F4FCE8;
		margin:0 -20px -10px -20px;
		padding: 10px 20px;
		}
		#done-items li{
		padding:10px 0;
		border-bottom:1px solid #ddd;
		text-decoration:line-through;
		}
		#done-items li:last-child{
		border-bottom:none;
		}
		#checkAll{
		margin-top:10px;
		}
			
	</style>
</head>
<body>
	<div class="container">
		<h3>{{ $message }}</h3>
		<div class="row">
		    <div class="col-md-6">
			<div class="todolist not-done">
			 <h1>Todos</h1>
			    <input type="text" class="form-control add-todo" placeholder="Add todo">
				<button id="checkAll" class="btn btn-success">Mark all as done</button>
				
				<hr>
				<ul id="sortable" class="list-unstyled">
				<li class="ui-state-default">
				    <div class="checkbox">
					<label>
					    <input type="checkbox" value="" />Take out the trash</label>
				    </div>
				</li>
				<li class="ui-state-default">
				    <div class="checkbox">
					<label>
					    <input type="checkbox" value="" />Buy bread</label>
				    </div>
				</li>
				<li class="ui-state-default">
				    <div class="checkbox">
					<label>
					    <input type="checkbox" value="" />Teach penguins to fly</label>
				    </div>
				</li>
			    </ul>
			    <div class="todo-footer">
				<strong><span class="count-todos"></span></strong> Items Left
			    </div>
			</div>
		    </div>
		    <div class="col-md-6">
			<div class="todolist">
			 <h1>Already Done</h1>
			    <ul id="done-items" class="list-unstyled">
				<li>Some item <button class="remove-item btn btn-default btn-xs pull-right"><span class="glyphicon glyphicon-remove"></span></button></li>
				
			    </ul>
			</div>
		    </div>
		</div>
	</div>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	
	<script>
		$("#sortable").sortable();
		$("#sortable").disableSelection();

		countTodos();

		// all done btn
		$("#checkAll").click(function(){
		AllDone();
		});

		//create todo
		$('.add-todo').on('keypress',function (e) {
		e.preventDefault
		if (e.which == 13) {
			if($(this).val() != ''){
			var todo = $(this).val();
			createTodo(todo); 
			countTodos();
			}else{
			// some validation
			}
		}
		});
		// mark task as done
		$('.todolist').on('change','#sortable li input[type="checkbox"]',function(){
		if($(this).prop('checked')){
			var doneItem = $(this).parent().parent().find('label').text();
			$(this).parent().parent().parent().addClass('remove');
			done(doneItem);
			countTodos();
		}
		});

		//delete done task from "already done"
		$('.todolist').on('click','.remove-item',function(){
		removeItem(this);
		});

		// count tasks
		function countTodos(){
		var count = $("#sortable li").length;
		$('.count-todos').html(count);
		}

		//create task
		function createTodo(text){
		var markup = '<li class="ui-state-default"><div class="checkbox"><label><input type="checkbox" value="" />'+ text +'</label></div></li>';
		$('#sortable').append(markup);
		$('.add-todo').val('');
		}

		//mark task as done
		function done(doneItem){
		var done = doneItem;
		var markup = '<li>'+ done +'<button class="btn btn-default btn-xs pull-right  remove-item"><span class="glyphicon glyphicon-remove"></span></button></li>';
		$('#done-items').append(markup);
		$('.remove').remove();
		}

		//mark all tasks as done
		function AllDone(){
		var myArray = [];

		$('#sortable li').each( function() {
			myArray.push($(this).text());   
		});
		
		// add to done
		for (i = 0; i < myArray.length; i++) {
			$('#done-items').append('<li>' + myArray[i] + '<button class="btn btn-default btn-xs pull-right  remove-item"><span class="glyphicon glyphicon-remove"></span></button></li>');
		}
		
		// myArray
		$('#sortable li').remove();
		countTodos();
		}

		//remove done task from list
		function removeItem(element){
		$(element).parent().remove();
		}
	</script>
</body>
</html>