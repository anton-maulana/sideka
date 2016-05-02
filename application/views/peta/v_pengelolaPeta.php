<script src="https://maps.googleapis.com/maps/api/js?v=3.exp?key=AIzaSyCRDoMePSoMWD2msayB5PdOK-KqxHFW6B0"></script>
<!-- Custom CSS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/maps/overlay.js"></script>

<script>

var map;
var _base_url = '<?= base_url() ?>';

function initialize() {
	var myLatlng = new google.maps.LatLng(<?= $peta->center?>);
	var mapOptions = {
		zoom: <?= $peta->zoom?>,
        center: myLatlng,
		 zoomControlOptions: {
        position: google.maps.ControlPosition.LEFT_CENTER
    },
        draggableCursor: 'default',
        draggingCursor: 'pointer',
        scaleControl: true,
        mapTypeControl: true,
        mapTypeId: google.maps.MapTypeId.<?= $peta->type;?>,
        streetViewControl: false
	};
	map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);
	
	//////LEGEND//////
	map.controls[google.maps.ControlPosition.TOP_RIGHT].push(
	document.getElementById('legend'));
	//////LEGEND//////
	
	//////LEGEND//////
	map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(
	document.getElementById('overlay_button'));
	//////LEGEND//////
	

	//////OVERLAY//////
	if(true == <?php echo $peta->tampil;?>)
	{	
	var swBound = new google.maps.LatLng(<?= $peta->point1?>); //point1
    var neBound = new google.maps.LatLng(<?= $peta->point2?>); //point2
    var bounds = new google.maps.LatLngBounds(swBound, neBound);

	
	console.log(map);
	var srcImage = _base_url+'<?= $peta->path_overlayImage;?>';				
	overlay = new DebugOverlay(bounds, srcImage, map);
	}
	else
	{
		document.getElementById('overlay_button').style.display = "none";
	}
	//////OVERLAY//////
	<?php 
	
		echo $batas_wilayah;
		foreach($tanah as $row)
		{
			echo $row->lokasi;
		}
		foreach($bangunan as $row)
		{
			echo $row->lokasi;
		}
		foreach($potensi as $row)
		{
			echo $row->lokasi;
		}
	?>
	google.maps.event.addListener(map, 'bounds_changed', function() {		
		if(document.getElementById("map_canvas").className == "active")
		{
			google.maps.event.trigger(map, 'resize');
			document.getElementById("map_canvas").className = "xxx";
		}
		
	});
}

	//initialize();
	google.maps.event.addDomListener(window, 'load', initialize);
	
	

  

</script>

<link href="<?php echo base_url(); ?>assetku/maps/style.css" rel="stylesheet">
<style>
  #legend {
    background: rgba(255,255,255,0.4);
    padding: 5px;
  } 
  #overlay_button {
    padding: 5px;
	margin: 5px;
  }
  #legend_table tr td {
    padding: 5px;
  }
</style>
<?php 	
	$logo_desa = $konten_logo->konten_logo_desa;
?>

<div class="row">
	<div class="col-md-7">
		<h3>Selamat Datang <b>Pengelola Peta</b></h3>
		<legend></legend>
	</div>
	<div class="col-md-5" >
	<img src="<?php echo site_url($logo_desa); ?>" style="float:right; height:fixed; width:250px; margin-top:10px; margin-bottom:10px;"> 		
	</div>
</div>

<div class="row">
	<div class="col-md-12 map">
		<div id="map_canvas"></div>
		<div id="legend">		
		  <table id="legend_table">
			<tr>
				<td><div style="width:10px;height:10px;border:1px solid; background-color:#FF0000; text-transform: capitalize;"></div></td>
				<td>Batas Wilayah</td>
				<td style="text-align:right;"><?= $legend_batas_wilayah;?> Ha</td>
			</tr>
			<?php 
			foreach($legend_tanah as $row)
			{
				echo '<tr>
						<td><div style="width:10px;height:10px;border:1px solid; background-color:#804000;"></div></td>
						<td style=" text-transform: capitalize;">Aset Tanah</td>
						<td style="text-align:right;">'.$row->total_luas.' Ha</td>
					</tr>';
			}
			foreach($legend_bangunan as $row)
			{
				echo '<tr>
						<td><div style="width:10px;height:10px;border:1px solid; background-color:#7E7EFF;"></div></td>
						<td style=" text-transform: capitalize;">Aset Bangunan</td>
						<td style="text-align:right;">'.$row->total_luas.' Ha</td>
					</tr>';
			}
			foreach($legend_potensi as $row)
			{
				echo '<tr>
						<td><div style="width:10px;height:10px;border:1px solid; background-color:'.$row->warna_peta.';"></div></td>
						<td style=" text-transform: capitalize;">'.$row->jenis_potensi.'</td>
						<td style="text-align:right;">'.$row->total_luas.' '.$row->satuan.'</td>
					</tr>';
			}
			?>
		  <table>
		</div>		
		<input type="button" id="overlay_button" class="btn-xs btn-warning" value="Image Overlay" onclick="overlay.toggleDOM();"></input>
	</div>
</div>

