
<!-- GET JQUERY FROM THE GOOGLE APIS -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp?key=AIzaSyCRDoMePSoMWD2msayB5PdOK-KqxHFW6B0"></script>
<script>
	var map;
	
	function initialize() {
		var myLatlng = new google.maps.LatLng(-2.873997, 108.281169);
		var mapOptions = {
			zoom: 15,
			center: myLatlng
		};
		map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);



	  // Define the LatLng coordinates for the polygon's path.
	  map.data.loadGeoJson('http://localhost/sideka_aset/aset.json');

	  // Construct the polygon.
	 // Add some style.
	  map.data.setStyle(function(feature) {
		return /** @type {google.maps.Data.StyleOptions} */({
		  fillColor: feature.getProperty('color'),
		  strokeWeight: 1
		});
	  });

	  // Set mouseover event for each feature.
	  map.data.addListener('mouseover', function(event) {
		document.getElementById('info-box').textContent =
			event.feature.getProperty('letter');
	  });
	}

	google.maps.event.addDomListener(window, 'load', initialize);

	/* function loadScript() {
	  var script = document.createElement('script');
	  script.type = 'text/javascript';
	  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp' +
		  '&signed_in=true&callback=initialize';
	  document.body.appendChild(script);
	}

	window.onload = loadScript; */
</script>

<?php 	
	$logo_desa = $konten_logo->konten_logo_desa;
?>

	<div class="row">
		<div class="col-md-6">
			<h3>Selamat Datang <b>Pengelola Aset</b></h3>
			<legend></legend>
		</div>
		<div class="col-md-6" >
		<img src="<?php echo site_url($logo_desa); ?>" style="float:right; height:fixed; width:250px; margin-top:20px; margin-bottom:-40px;"> 		
		</div>
		<div class="col-md-12">
			<a href="<?php echo site_url('aset/c_aset/add');?>">
				<button type="button" class="btn btn-success"><i class="fa fa-plus-square fa-fw"></i> Tambah Aset</button>
			</a>
			<a href="<?php echo site_url('aset/c_aset/');?>">
				<button type="button" class="btn btn-success"><i class="fa fa-list fa-fw"></i> Daftar Aset</button>
			</a>			
		</div>
	</div>
	<br>
	
	
	<div class="row">	
		<div class="col-md-12 map">
		<div id="map-canvas"></div>

		<?php //echo $peta;?>
		</div>
		
		
	</div>
	<!-- /.row -->
     
		


<style>
#map-canvas { height: 80% }
</style>

<script>
function nav_active(){
	document.getElementById("a-pengelola-aset").className = "collapsed active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>
