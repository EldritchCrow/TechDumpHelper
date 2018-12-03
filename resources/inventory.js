$(document).ready(function(){

	// Get the categories and create the checkboxes in the new item form
	$.ajax({
		type: 'GET',
		url: 'get_categories.php',
		dataType: 'json',
		success: function(data){
			$.each(data, function(i, category){
				$('#new-item form .item-categories').append('<label class="item-category"><input type="checkbox" name="category[]" value="' + category['id'] + '">' + category['name'] + '</label>');
			});
		},
		error: function(xhr, status, msg){
			alert('Error: Failed to load categories.\nStatus: ' + status + '\nError Message: ' + msg);
			console.error(status + ': ' + msg);
		}
	});

	// Get the inventory items and create the list
	$.ajax({
		type: 'GET',
		url: 'get_inventory.php',
		data: {
			'td': td
		},
		dataType: 'json',
		success: function(data){
			renderItems(data);
			// Get the previous inventory items and add them to the list
			$.ajax({
				type: 'GET',
				url: 'get_inventory.php',
				data: {
					'td': td,
					'deleted': null
				},
				dataType: 'json',
				success: function(data){
					renderItems(data, true);
				},
				error: function(xhr, status, msg){
					alert('Error: Failed to load deleted inventory data.\nStatus: ' + status + '\nError Message: ' + msg);
					console.error('Failed to load deleted inventory data.\nStatus: ' + status + '\nError Message: ' + msg);
					console.error(status + ': ' + msg);
				}
			});
		},
		error: function(xhr, status, msg){
			alert('Error: Failed to load inventory data.\nStatus: ' + status + '\nError Message: ' + msg);
			console.error('Failed to load inventory data.\nStatus: ' + status + '\nError Message: ' + msg);
			console.error(status + ': ' + msg);
		}
	});

});

function renderItems(data, deleted = false){
	$.each(data, function(i, item){
		var output = '<div class="item' + (deleted ? ' item-deleted"' : '"') + '>';
		if(!deleted) output += '<button class="item-delete" onclick="deleteItem(' + item['id'] + ');">&cross;</button>';
		if(item['hasPicture']) output += '<a href="../resources/item_pictures/' + item['id'] + '.jpg" target="_blank"><img class="item-image" src="../resources/item_pictures/thumbnails/' + item['id'] + '.jpg" height="135"></a>';
		else output += '<img class="item-image" src="../resources/item_pictures/thumbnails/item_placeholder.png">';
		output += '<div class="item-information">';
		output += '<h3 class="item-title">' + item['title'] + '</h3>';
		output += '<div class="item-categories">';
		$.each(item['categories'], function(ic, category){
			output += '<div class="item-category">' + category + '</div>';
		});
		output += '</div>';
		output += '<p class="item-description">' + item['description'] + '</p>';
		output += '<div class="item-datetime">Posted: ' + item['datetime'] + (deleted ? ', Deleted: ' + item['datetimeDeleted'] : '') + '</div>';
		output += '</div>';
		output += '</div>';
		$('#inventory').append(output);
	});
}

// Mark an item as claimed
function deleteItem(id){
	$.ajax({
		type: 'GET',
		url: 'delete_inventory.php',
		data: {
			itemid: id
		},
		success: function(){
			location.reload();
		},
		error: function(xhr, status, msg){
			alert('Error: Failed to delete item.\nStatus: ' + status + '\nError Message: ' + msg);
			console.error('Failed to delete item.\nStatus: ' + status + '\nError Message: ' + msg);
			console.error(status + ': ' + msg);
		}
	});
}