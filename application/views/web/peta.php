

<!-- Form to turn layers on/off -->

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp?key=AIzaSyCRDoMePSoMWD2msayB5PdOK-KqxHFW6B0"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/maps/overlay.js"></script>
<script>
var map;
var _base_url = '<?= base_url() ?>';
function initialize() {
	var myLatlng = new google.maps.LatLng(<?= $peta->center?>);
	var mapOptions = {
		zoom: <?= $peta->zoom?>,
        center: myLatlng,
        draggableCursor: 'default',
        draggingCursor: 'pointer',
        scaleControl: true,
        mapTypeControl: true,
        mapTypeId: google.maps.MapTypeId.<?= $peta->type;?>,
        streetViewControl: true
	};
	map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
	
	//////LEGEND//////
	map.controls[google.maps.ControlPosition.TOP_RIGHT].push(
	document.getElementById('legend'));
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
	//////OVERLAY//////
	<?php 
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

}

google.maps.event.addDomListener(window, 'load', initialize);


</script>
<link href="<?php echo base_url(); ?>assetku/maps/style.css" rel="stylesheet">
<style>
iframe {width:100%;height:600px;}
#map-canvas { height: 100% }
 #legend {
    background: rgba(255,255,255,0.4);
    padding: 5px;
    
    text-transform: capitalize;
  } 
  #overlay_button {
    padding: 5px;
	margin: 5px;
  }
  #legend tr td {
    padding: 5px;
  }
</style>

	


<div class="col-md-12 map">
<div id="map-canvas"></div>
	
	<div id="legend">		
	<table>
	<tr>
		<td><div style="width:10px;height:10px;border:1px solid; background-color:#FF0000;"></div></td>
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
	</table>
	</div>

</div>


<script type="text/javascript" charset="utf-8">			
			 function nav_active(){
				var r = document.getElementById("nav-home");
				r.className = "";
				
				var d = document.getElementById("nav-peta");
				d.className = "active";
				}
				
			$(document).ready(function(){  
				//doIframe();
			});
		
		
</script>