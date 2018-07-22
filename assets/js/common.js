$("#saveForm").click(function(){
	var name 		= $('.name').val();
	var mobile 		= $('.mobile').val();
	var gender 		= $('input[name="gender"]:checked').val();
	var location 	= $('.location').val();
	var latitude 	= $('.lat').val();
	var longitude 	= $('.lng').val();

	var mobileRegEx = new RegExp("^[4-9]{1}[0-9]{9}$");

	$('.error_show').hide();
	
	$('.alert-dismissible').hide();
	
	if(name == ''){
		$('.name').focus();
		$('.error_show').show();
		$('.error_msg').text('Please Fill Name.');
	}else if(mobile == ''){
		$('.mobile').focus();
		$('.error_show').show();
		$('.error_msg').text('Please Fill Mobile Number.');
	}else if(!(mobileRegEx.test(mobile))){
		$('.mobile').focus();
		$('.error_show').show();
		$('.error_msg').text('Please Correct Mobile Number.');
	}else if(gender == '' || gender == undefined){
		$('.gender').focus();
		$('.error_show').show();
		$('.error_msg').text('Please Fill Gender.');
	}else if(location == ''){
		$('.location').focus();
		$('.error_show').show();
		$('.error_msg').text('Please Fill Location.');
	}else if(latitude == '' || longitude == ''){
		$('.location').focus();
		$('.error_show').show();
		$('.error_msg').text('Please Fill Location.');
	}else {
		$('.error_show').hide();
		var action 		= "formSave";
		$.ajax({
			url 		: 'backend/common.php',
			method 		: 'POST',
			dataType 	: 'JSON',
			async 		: true,
			data 		: {
				action 		: action,
				name		: name, 	
				mobile		: mobile, 	
				gender		: gender, 	
				location	: location,
				latitude	: latitude,
				longitude	: longitude	 
			}
		}).done(function(res){
			if(res.status){
				$('.success_show').show();
				$('.success_msg').text('Successfully Saved.');
				setTimeout(function(){
					window.location.href = "lists.php";
				},1000);
			}else {
				$('.error_show').show();
				$('.error_msg').text('Oops! Some Error Occur, Please Try Again.');	
			}
		});
	}
});

$("#updateForm").click(function(){
	var id 			= $('#updateForm').val();
	var name 		= $('.name').val();
	var mobile 		= $('.mobile').val();
	var gender 		= $('input[name="gender"]:checked').val();
	var location 	= $('.location').val();
	var latitude 	= $('.lat').val();
	var longitude 	= $('.lng').val();

	var mobileRegEx = new RegExp("^[4-9]{1}[0-9]{9}$");

	$('.error_show').hide();
	
	if(id == ''){
		window.location.href = 'index.php';
	}else if(name == ''){
		$('.name').focus();
		$('.error_show').show();
		$('.error_msg').text('Please Fill Name.');
	}else if(mobile == ''){
		$('.mobile').focus();
		$('.error_show').show();
		$('.error_msg').text('Please Fill Mobile Number.');
	}else if(!(mobileRegEx.test(mobile))){
		$('.mobile').focus();
		$('.error_show').show();
		$('.error_msg').text('Please Correct Mobile Number.');
	}else if(gender == '' || gender == undefined){
		$('.gender').focus();
		$('.error_show').show();
		$('.error_msg').text('Please Fill Gender.');
	}else if(location == ''){
		$('.location').focus();
		$('.error_show').show();
		$('.error_msg').text('Please Fill Location.');
	}else if(latitude == '' || longitude == ''){
		$('.location').focus();
		$('.error_show').show();
		$('.error_msg').text('Please Fill Location.');
	}else {
		var action 		= "formUpdate";
		$.ajax({
			url 		: 'backend/common.php',
			method 		: 'POST',
			dataType 	: 'JSON',
			async 		: true,
			data 		: {
				action 		: action,
				id 			: id,
				name		: name,
				mobile		: mobile,
				gender		: gender,
				location	: location,
				latitude	: latitude,
				longitude	: longitude
			}
		}).done(function(res) {
			if(res.status){
				$('.success_show').show();
				$('.success_msg').text('Successfully Updated.');
				setTimeout(function(){
					window.location.href = "lists.php";
				},1000);
			}else {
				$('.error_show').show();
				$('.error_msg').text('Oops! Some Error Occur, Please Try Again.');
			}
		});
	}	
});

$("#userLists").on('click','.deleteData',function(){
	var elem 	= $(this);
	var id 		= $(this).parents('td').data('id');
	
	$('.alert-dismissible').hide();

	var action 	= 'deleteData';
	$.ajax({
		url 		: 'backend/common.php',
		method 		: 'POST',
		dataType 	: 'JSON',
		async 		: true,
		data 		: {
			action 		: action,
			id 			: id,
		}
	}).done(function(res){
		if(res.status){
			$('.success_show').show();
			$('.success_msg').text('Successfully Deleted.');
			$(elem).parents('tr').remove();
			var rowCount    =  $("#userLists tr").length;
			if(rowCount == 0){
				$("#userLists").append('<tr><td class="text-center" colspan="7">No User Added</td></tr>');
			}else {
				var i = 0;
				$("#userLists tr").find('td:first').each(function(){
				    i++;
				    $(this).html(i);
				});	
			}	
		}else {
			$('.error_show').show();
			$('.error_msg').text('Oops! Some Error Occur, Please Try Again.');
		}
	});
});

function LoadLists() {
	var action 		= "formsLoad";
	$.ajax({
		url 		: 'backend/common.php',
		method 		: 'POST',
		dataType 	: 'JSON',
		async 		: true,
		data 		: {
			action 		: action, 
		}
	}).done(function(res){
		if(res.status){
			if(res.message.length == 0){
				$("#userLists").append('<tr><td class="text-center" colspan="7">No User Added</td></tr>');
			}else {
				$("#userLists").html();
				var sno 	= 1;
				$(res.message).each(function(index,value){
					$("#userLists").append(
						'<tr>'
							+'<td class="text-center">'+sno+'.</td>'
				      		+'<td class="text-center">'+value[1]+'</td>'
				      		+'<td class="text-center">'+value[2]+'</td>'
				      		+'<td class="text-center">'+value[3]+'</td>'
				      		+'<td class="text-center" style="max-width:200px">'+value[4]+'</td>'
				      		+'<td class="text-center" style="min-width:300px">'
				      			+'<div id="map_canvas_'+sno+'" data-id="'+value[4]+'" style="width:100%; height:100px;"></div>'
			      			+'</td>'
				      		+'<td class="text-center" data-id='+value[0]+'>'
				      		+'<a href="index.php?id='+value[0]+'"><i class="fa fa-pencil editData" aria-hidden="true" data-lat="'+value[5]+'" data-lng="'+value[6]+'" style="color:blue;cursor:pointer"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;'
				      		+'<i class="fa fa-trash deleteData" aria-hidden="true" style="color:red;cursor:pointer"></i></td>'+
			    		'</tr>'
		    		);
		    		sno++;
				});
				window.LoadData = res.message;
				$.getScript("https://maps.googleapis.com/maps/api/js?key=AIzaSyDH8lnT6MPPdI2zbqegQq04mtjoJds068M&callback=initialize");
			}
		}
	});
}

function numbersonly(myfield,e,dec) {
    var key;
    var keychar;

    if (window.event)
       key = window.event.keyCode;
    else if (e)
       key = e.which;
    else
       return true;
    keychar = String.fromCharCode(key);

    // control keys
    if ((key == null) || (key == 0) || (key == 8) || (key == 9) || (key == 13) || (key == 27))
       return true;

    // numbers
    else if ((("0123456789").indexOf(keychar) > -1))
       return true;

    // decimal point jump
    else if (dec && (keychar == ".")){
       myfield.form.elements[dec].focus();
       return false;
    }
    else
       return false;
}
