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