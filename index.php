<?php 
	include 'inc/header.php'; 
	require_once 'backend/db.php';
?>
<?php 
	if(!empty($_GET['id']) && $_GET['id']){
		$id = $_GET['id'];

		$select_list   	= "SELECT * FROM `users` WHERE id='$id'";
		$selected_list 	= $conn->query($select_list);

		if($selected_list->num_rows > 0){
			$datas 			= $selected_list->fetch_assoc();
			$id 			= $datas['id'];
			$name 			= $datas['name'];
			$mobile 		= $datas['mobile'];
			$gender 		= $datas['gender'];
			$location 		= $datas['location'];
			$latitude 		= $datas['latitude'];
			$longitude 		= $datas['longitude'];
		}else {
			header('location:index.php');
		}

	}
?>
	<center>
		<h3 style="margin-top:20px">FORM</h3>
	</center>
	<div class="container">
		<div class="row" style="margin-top:60px">
			<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
				<div class="form-group">
			      	<label for="exampleInputEmail1">Name</label>
			      	<input type="text" class="form-control name" placeholder="Name" value="<?php if(!empty($name)) echo $name; ?>">
			    </div>
			    <div class="form-group">
			      	<label for="exampleInputEmail1">Mobile</label>
			      	<input type="text" class="form-control mobile" onkeypress="return numbersonly(this,event)" maxlength="10" placeholder="Mobile" value="<?php if(!empty($mobile)) echo $mobile; ?>">
			    </div>
			    <div class="row">
			    	<div class="col-md-5">
			    	    <div class="form-group">
			    	    	<label>Gender</label>
			    		    <div class="form-check">
			    		    	<div class="row">
			    		    		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			    				      	<label class="form-check-label">
			    				        	<input type="radio" class="form-check-input" name="gender" value="FEMALE" <?php if(!empty($gender) && $gender == "FEMALE"){echo 'checked'; }?>> FEMALE
			    				      	</label>
			    				    </div>
			    				    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			    			      		<label class="form-check-label">
			    			      	    	<input type="radio" class="form-check-input" name="gender" value="MALE" <?php if(!empty($gender) && $gender == "MALE"){echo 'checked'; }?>> MALE
			    			      	  	</label>
			    			      	</div>
			    			    </div>  	  	
			    		    </div>
			    		</div>	
			    	</div>
			    	<div class="col-md-1"></div>
			    	<div class="col-md-6">
					    <div class="form-group">
					      	<label for="exampleInputEmail1">Location</label>
					      	<input id="user_location" type="text" class="form-control location" placeholder="Location" value="<?php if(!empty($location)) echo $location; ?>">
					    </div>
					    <input type="hidden" class="lat" value="<?php if(!empty($latitude)) echo $latitude; ?>" />
					    <input type="hidden" class="lng" value="<?php if(!empty($longitude)) echo $longitude; ?>"/>
					</div>
				</div>
				<?php
					if(empty($id)) {
				?>
			    		<button type="submit" class="btn btn-primary" id="saveForm">SAVE</button>
				<?php
					} else {
				?>
						<button type="submit" class="btn btn-primary" id="updateForm" value="<?php echo $id; ?>">UPDATE</button>
				<?php		
					}
			    ?>	
			</div>
		</div>
	</div>
<?php include 'inc/footer.php'; ?>
<script type="text/javascript">
	function initAutocomplete() {
	  	// Create the search box and link it to the UI element.
	  	var input = document.getElementById('user_location');
	  	var searchBox = new google.maps.places.SearchBox(input);
	  	
	  	// Listen for the event fired when the user selects a prediction and retrieve
	  	// more details for that place.
	  	searchBox.addListener('places_changed', function() {
	    	var places = searchBox.getPlaces();

		    if (places.length == 0) {
		      return;
		    }

		    // For each place, get the icon, name and location.
		    var bounds = new google.maps.LatLngBounds();
		    places.forEach(function(place) {
		      if (!place.geometry) {
		        console.log("Returned place contains no geometry");
		        return;
		      }

		      $(".lat").val(place.geometry.location.lat());
		      $(".lng").val(place.geometry.location.lng());
		    });
	  	});
	}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDH8lnT6MPPdI2zbqegQq04mtjoJds068M&libraries=places&callback=initAutocomplete" async defer></script>