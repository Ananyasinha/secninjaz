<?php include 'inc/header.php'; ?>
	<center>
		<h3 style="margin-top:20px">LISTS</h3>
	</center>
	<div class="container">
		<table class="table table-hover table-bordered">
		  <thead>
		    <tr>
		      <th class="text-center">S No.</th>
		      <th class="text-center">NAME</th>
		      <th class="text-center">MOBILE</th>
		      <th class="text-center">GENDER</th>
		      <th class="text-center">LOCATION</th>
		      <th class="text-center">MAP</th>
		      <th class="text-center">ACTION</th>
		    </tr>
		  </thead>
		  <tbody id="userLists"></tbody>
		</table> 
	</div>
	
	<div class="modal" id="infoModal">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Edit Details</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body editDetails">
	        <div class="container">
	        	<div class="row">
	        		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
	        			<div class="form-group">
	        		      	<label for="exampleInputEmail1">Name</label>
	        		      	<input type="text" class="form-control name" placeholder="Name">
	        		    </div>
	        		    <div class="form-group">
	        		      	<label for="exampleInputEmail1">Mobile</label>
	        		      	<input type="text" class="form-control mobile" placeholder="Mobile">
	        		    </div>
	        		    <div class="row">
	        		    	<div class="col-md-5">
	        		    	    <div class="form-group">
	        		    	    	<label>Gender</label>
	        		    		    <div class="form-check">
	        		    		    	<div class="row">
	        		    		    		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	        		    				      	<label class="form-check-label">
	        		    				        	<input type="radio" class="form-check-input" name="gender" value="FEMALE" checked> FEMALE
	        		    				      	</label>
	        		    				    </div>
	        		    				    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	        		    			      		<label class="form-check-label">
	        		    			      	    	<input type="radio" class="form-check-input" name="gender" value="MALE"> MALE
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
	        				      	<input id="user_location" type="text" class="form-control location" placeholder="Location">
	        				    </div>
	        				    <input type="hidden" class="lat" />
	        				    <input type="hidden" class="lng" />
	        				</div>
	        				
	        			</div>
	        		    <button type="submit" class="btn btn-primary" id="saveForm">SAVE</button>
	        		</div>
	        	</div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" id="updateForm">Save changes</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

<?php include 'inc/footer.php'; ?>
<script type="text/javascript">
	$(document).ready(function(){
		LoadLists();
	});

	function initialize(){
		var sno 	 = 1;
		$(window.LoadData).each(function(index,value){
			var lat  = parseFloat(value[5]);
			var lng  = parseFloat(value[6]);
			var myOptions = {
		        zoom: 14,
		        center: new google.maps.LatLng(lat,lng),
		    }
		    var canvas = document.getElementById("map_canvas_"+sno);
		    var map = new google.maps.Map(canvas,myOptions);
			
			var marker = new google.maps.Marker({
				position : {lat:lat,lng:lng},
				map : map
			});	
			sno++;
		});
	}
</script>