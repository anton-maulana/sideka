<h3><?= $page_title ?></h3>
<legend></legend>
<body id="body" onload="initmap()">	
<div class="row">
	<div class="form-group"> 
		<div class="col-md-7 col-lg-9">		
			<form action="#" onsubmit="showAddress(this.address.value); return false">
			<div class="input-group">
				 <span class="input-group-addon"><i class="fa fa-search fa-fw "></i></span>
				 <input type="text" size="50" name="address" value="" placeholder="Pencarian" class="form-control input-md"/>
			</div>			
			</form>
		</div>		
		<div class="col-md-5 col-lg-3"> 
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-hand-o-up fa-fw "></i></span>
				<input id="posisi" name="posisi" type="text" class="form-control input-md" disabled>	
			</div>											
		</div>
	</div>

	<div class="col-md-12">
	<div id="map_canvas"></div>
	</div>
</div>	
<legend><br></legend>

<div class="alert alert-info col-md-12">
			Menu <b>Peta Dasar</b> adalah pengaturan yang digunakan sebagai acuan untuk semua peta yang akan ditampilan, anda dapat mengatur informasi peta seperti <i>Map Zoom</i>, <i>Map Center</i> dan <i>Map Type</i>.						
</div>	
<div class="row">
<?php
	$attributes = array('id' => 'myform');
	echo form_open_multipart('peta/c_petaDasar/simpan_peta', $attributes); 
	?>
	<div class="form-group">
		<label class="col-md-2 control-label" for="myzoom"><i>Map Zoom</i></label>
		<div class="col-md-10 ">
			<input id="myzoom" name="myzoom" type="text" value="<?= $peta->zoom;?>" class="form-control input-md" readonly="readonly" />
			<span class="help-block"></span>		
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-2 control-label" for="centerofmap"><i>Map Center</i></label>
		<div class="col-md-10">	
			<input type="text" id="centerofmap" name="centerofmap" value="<?= $peta->center;?>" class="form-control input-md" readonly="readonly" />		
			<span class="help-block"></span>
		</div>	
	</div>
	<div class="form-group">
		<label class="col-md-2 control-label" for="mapType"><i>Map Type</i></label>
		<div class="col-md-10 ">	
		<input type="text" id="mapType" name="mapType" value="<?= $peta->type;?>" class="form-control input-md" readonly="readonly" style="text-transform: uppercase"/>		
			<span class="help-block">
				<div align="right">Pilihan <b><i>Map Type</i></b> tersedia di layar peta</div>
			</span>
		</div>		
	</div>

	<div class="form-group"> 	
    	<label class="col-md-2 control-label" for="overlayImage"><i>Image Overlay</i></label>
        <div class="col-md-6 col-lg-8">		
			<input class="form-control input-md"  type="file" name="overlayImage" id="imgInp" multiple>			
			<div class="checkbox">
			  <label><input type="checkbox" name="tampil" value="true" <?php if($peta->tampil == "true")echo 'checked';?> > Tampilkan <i>Image Overlay</i></label>
				
			</div>
		</div>
		<div class="col-md-4 col-lg-2">
			<img id="blah" src='<?php  echo base_url(); ?><?= $peta->path_overlayImage;?>'  alt="your image"  class="img-responsive img-thumbnail"  width="150px" height="200px"/><br><br>
			<input type="hidden" id="path_overlayImage" name="path_overlayImage" value="<?= $peta->path_overlayImage;?>" />	
			<input type="hidden" name="changeOverlay" id="changeOverlay" value="TIDAK" />	
		</div>
	</div>
	
	
	<input type="hidden" name="point1" id="point1" value="<?= $peta->point1;?>" />	<br>
	<input type="hidden" name="point2" id="point2" value="<?= $peta->point2;?>" />	
	<legend></legend>
	
	<div class="form-group">
	  <label class="col-md-0 control-label" for="simpan"></label>
	  <div class="col-md-9">
		<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
	  </div>
	</div>
	<?php echo form_close(); ?>
	
	<br><br>
	
</div>

<script>
function readURL_overlayImage(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }
		
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imgInp").change(function(){
    readURL_overlayImage(this);
	document.getElementById("changeOverlay").value = "YA";
});

function nav_active(){	
	document.getElementById("a-dasar").className = "collapsed active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp?key=AIzaSyCRDoMePSoMWD2msayB5PdOK-KqxHFW6B0"></script>
<!-- Custom CSS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/maps/overlay.js"></script>

<script>
var _base_url = '<?= base_url() ?>';
function initmap(){	
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(<?= $peta->center;?>);
    //var latlng = new google.maps.LatLng(-2.873997, 108.281169);
    var mapTypeIds = [];
    for(var type in google.maps.MapTypeId) {
        mapTypeIds.push(google.maps.MapTypeId[type]);
		
    }
    copyrightNode = document.createElement('div');
    copyrightNode.id = 'copyright-control';
    copyrightNode.style.fontSize = '11px';
    copyrightNode.style.fontFamily = 'Arial, sans-serif';
    copyrightNode.style.margin = '0 2px 2px 0';
    copyrightNode.style.whiteSpace = 'nowrap';
    //copyrightNode.index = 0;
    var myOptions = {
        zoom: <?= $peta->zoom;?>,
        //zoom: 7,
        center: latlng,
        draggableCursor: 'default',
        draggingCursor: 'pointer',
        scaleControl: true,
        mapTypeControl: true,
        mapTypeControlOptions: {mapTypeIds: mapTypeIds},
        //mapTypeControlOptions:{style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
        mapTypeId: google.maps.MapTypeId.<?= $peta->type;?>,
        //mapTypeId: google.maps.MapTypeId.SATELLITE,
        styles: [{featureType: 'poi', stylers: [{visibility: 'off'}]}],
        streetViewControl: false
	};
	
    map = new google.maps.Map(gob('map_canvas'),myOptions);
    
    google.maps.event.addListener(map, 'maptypeid_changed', updateCopyrights);
    map.controls[google.maps.ControlPosition.BOTTOM_RIGHT].push(copyrightNode);	
    google.maps.event.addListener(map, 'click', addLatLng);
    google.maps.event.addListener(map,'zoom_changed',mapzoom);
    cursorposition(map);
	
	google.maps.event.addListener(map, 'center_changed', function() {
    mapcenter();
	});
  
	/******DECALRE FORM******/
	document.getElementById("mapType").value = map.getMapTypeId();
	mapcenter();
	/******END OF DECALRE FORM******/
	
	//////OVERLAY//////
	if(true == <?php echo $peta->tampil;?>)
	{
		
		var swBound = new google.maps.LatLng(<?= $peta->point1;?>); //point1
		var neBound = new google.maps.LatLng(<?= $peta->point2;?>); //point2
		var bounds = new google.maps.LatLngBounds(swBound, neBound);
		
		console.log(map);
		var srcImage = _base_url+'<?= $peta->path_overlayImage;?>';		
		overlay = new DebugOverlay(bounds, srcImage, map);
	
		var markerA = new google.maps.Marker({
					position: swBound,
					map: map,
					draggable:true
				});

		var markerB = new google.maps.Marker({
				position: neBound,
				map: map,
				draggable:true
			});
			
		google.maps.event.addListener(markerA,'drag',function(point){
			
			var newPointA = markerA.getPosition();
			var newPointB = markerB.getPosition();
			var newBounds =  new google.maps.LatLngBounds(newPointA, newPointB);
			overlay.updateBounds(newBounds);
			overlay.geserOpacity();
			var latLngStr6 = point.latLng.lat().toFixed(6) + ', ' + point.latLng.lng().toFixed(6);
			gob('posisi').value = latLngStr6;
				
			});

		google.maps.event.addListener(markerB,'drag',function(point){

			var newPointA = markerA.getPosition();
			var newPointB = markerB.getPosition();
			var newBounds =  new google.maps.LatLngBounds(newPointA, newPointB);
			overlay.updateBounds(newBounds);
			overlay.geserOpacity();
			var latLngStr6 = point.latLng.lat().toFixed(6) + ', ' + point.latLng.lng().toFixed(6);
			gob('posisi').value = latLngStr6;
		});

		google.maps.event.addListener(markerA, 'dragend', function () {

			var newPointA = markerA.getPosition();
			var newPointB = markerB.getPosition();			
			console.log("point1"+ newPointA);
			console.log("point2"+ newPointB);
			document.getElementById("point1").value = newPointA;
			overlay.endGeserOpacity();
		});

		google.maps.event.addListener(markerB, 'dragend', function () {
			var newPointA = markerA.getPosition();
			var newPointB = markerB.getPosition();
			console.log("point1"+ newPointA);
			console.log("point2"+ newPointB);
			document.getElementById("point2").value = newPointB;
			overlay.endGeserOpacity();
		});
		
	}
	google.maps.event.addListener(map, 'bounds_changed', function() {		
		if(document.getElementById("map_canvas").className == "active")
		{
			google.maps.event.trigger(map, 'resize');
			document.getElementById("map_canvas").className = "xxx";
		}
		
	});
}
function updateCopyrights() {
    if(map.getMapTypeId() == "OSM") {
        copyrightNode.innerHTML = "OSM map data @<a target=\"_blank\" href=\"http://www.openstreetmap.org/\"> OpenStreetMap</a>-contributors,<a target=\"_blank\" href=\"http://creativecommons.org/licenses/by-sa/2.0/legalcode\"> CC BY-SA</a>";
    }else{
        copyrightNode.innerHTML = "";
		document.getElementById("mapType").value = map.getMapTypeId();
    }
}

</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/maps/nganu.js"></script>  
<link href="<?php echo base_url(); ?>assetku/maps/style.css" rel="stylesheet">
<!--
<div id ="panel">
      <input type="button" value="Toggle visibility" onclick="overlay.toggle();"></input>
      <input type="button" value="Toggle DOM attachment" onclick="overlay.toggleDOM();"></input>
</div>-->
