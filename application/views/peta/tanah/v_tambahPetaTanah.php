<script src="https://maps.googleapis.com/maps/api/js?v=3.exp?key=AIzaSyCRDoMePSoMWD2msayB5PdOK-KqxHFW6B0"></script>
<!-- Custom CSS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/maps/overlay.js"></script>

<script>
var map;
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
        center: latlng,
        draggableCursor: 'default',
        draggingCursor: 'pointer',
        scaleControl: true,
        mapTypeId: google.maps.MapTypeId.<?= $peta->type;?>,
        styles: [{featureType: 'poi', stylers: [{visibility: 'off'}]}],
        streetViewControl: false
	};
    map = new google.maps.Map(gob('map_canvas'),myOptions);
	
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
	
	
    map.mapTypes.set("OSM", new google.maps.ImageMapType({
        getTileUrl: function(coord, zoom) {
            return "http://tile.openstreetmap.org/" + zoom + "/" + coord.x + "/" + coord.y + ".png";
        },
        tileSize: new google.maps.Size(256, 256),
        name: "OpenStreetMap",
        maxZoom: 18
    }));
	
	

    polyPoints = new google.maps.MVCArray(); // collects coordinates
    tmpPolyLine.setMap(map);
    createplacemarkobject();
    createlinestyleobject();
    createpolygonstyleobject();
    createcirclestyleobject();
    createmarkerstyleobject();
    preparePolyline(); // create a Polyline object

    google.maps.event.addListener(map, 'click', addLatLng);
    google.maps.event.addListener(map,'zoom_changed',mapzoom);
    cursorposition(map);
	
	startState();
	
	google.maps.event.addListener(map, 'bounds_changed', function() {		
		if(document.getElementById("map_canvas").className == "active")
		{
			google.maps.event.trigger(map, 'resize');
			document.getElementById("map_canvas").className = "xxx";
		}
		
	});
	
}
function startState(){
		
		clearMap();
		
		<?php 
			if($tanah->lokasi != null OR $tanah->lokasi != "")
			{
				echo $tanah->lokasi; 
				?>
				///////////inisialiasi map lama/////////////////
				itTanah<?=$tanah->id_aset_tanah?>.setMap(null);
				polyShape = new google.maps.Polygon(polyOptionsTanah<?=$tanah->id_aset_tanah?>);
				polyShape.setMap(map);
				///////////end inisialiasi map lama/////////////////
				
				////////////////////////////
				
				pointsArray = arrayLoc;
				
		
				<?php
			}
			else $mapEmpty = true;
		?>
		
		/////////////////////////////////		
		stopediting();		
		codeID = gob('codechoice').value = 2;
		setCode();
		toolID = gob('toolchoice').value = 2; // editing is set to be possible only in polyline draw mode
		setTool();
		document.getElementById("simpan").disabled = true;
		
		//gob('coords1').value = gob('tempLoc').value;
			
}

function updateCopyrights() {
    if(map.getMapTypeId() == "OSM") {
        copyrightNode.innerHTML = "OSM map data @<a target=\"_blank\" href=\"http://www.openstreetmap.org/\"> OpenStreetMap</a>-contributors,<a target=\"_blank\" href=\"http://creativecommons.org/licenses/by-sa/2.0/legalcode\"> CC BY-SA</a>";
    }else{
        copyrightNode.innerHTML = "";
		document.getElementById("mapType").value = map.getMapTypeId();
    }
}

function polystyle() {
    this.name = "Lump";
    this.kmlcolor = "CD0000FF";
    this.kmlfill = "9AFF0000";
    this.color = "#804000";
    this.fill = "#804000";
    this.width = 1.1;
    this.lineopac = 0.7;
    this.fillopac = 0.6;
}
function logCode4(){
    if (notext === true) return;
    gob('coords1').value = 'var myCoordinatesTanah<?=$tanah->id_aset_tanah?> = [\n';
	var arrayLoc = '[';
    for(var i=0; i<pointsArray.length; i++){
        if(i == pointsArray.length-1){
            gob('coords1').value += 'new google.maps.LatLng('+pointsArray[i] + ')\n';
			arrayLoc += '"'+pointsArray[i] + '"';
        }else{
            gob('coords1').value += 'new google.maps.LatLng('+pointsArray[i] + '),\n';
			arrayLoc += '"'+pointsArray[i] + '",';
        }
    }
	arrayLoc += ']';
    if(toolID == 1){
        gob('coords1').value += '];\n';
        var options = 'var polyOptions = {\n'
        +'path: myCoordinates,\n'
        +'strokeColor: "'+polylinestyles[lcur].color+'",\n'
        +'strokeOpacity: '+polylinestyles[lcur].lineopac+',\n'
        +'strokeWeight: '+polylinestyles[lcur].width+'\n'
        +'}\n';
        gob('coords1').value += options;
        gob('coords1').value +='var it = new google.maps.Polyline(polyOptions);\n'
        +'it.setMap(map);\n';
        placemarks[plmcur].poly = "pl";
    }
    if(toolID == 2){
        gob('coords1').value += '];\n';
        var options = 'var polyOptionsTanah<?=$tanah->id_aset_tanah?> = {\n'
        +'path: myCoordinatesTanah<?=$tanah->id_aset_tanah?>,\n'
        +'strokeColor: "'+polygonstyles[pcur].color+'",\n'
        +'strokeOpacity: '+polygonstyles[pcur].lineopac+',\n'
        +'strokeWeight: '+polygonstyles[pcur].width+',\n'
        +'fillColor: "'+polygonstyles[pcur].fill+'",\n'
        +'fillOpacity: '+polygonstyles[pcur].fillopac+',\n'	
		+'zIndex: 0,\n'
        +'position: new google.maps.LatLng('+pointsArray[0] + ')\n'
        +'}\n';
        gob('coords1').value += options;
        gob('coords1').value +='var itTanah<?=$tanah->id_aset_tanah?> = new google.maps.Polygon(polyOptionsTanah<?=$tanah->id_aset_tanah?>);\n'
		+'itTanah<?=$tanah->id_aset_tanah?>.setMap(map);\n'
        +'var infoTanah<?=$tanah->id_aset_tanah?> = new google.maps.InfoWindow({content: "<b>Aset Tanah</b> <table><tr><td>no sertifikat</td><td> : <?= $tanah->no_sertifikat?></td></tr><tr><td>Luas Tanah</td><td> : <?= $tanah->luas?> Ha</td></tr><tr><td>Kepemilikan</td><td> : <?= $kepemilikan?></td></tr><tr><td>Deskripsi</td><td> : <?= $tanah->deskripsi?></td></tr></table>"});\n'
        +'google.maps.event.addListener(itTanah<?=$tanah->id_aset_tanah?>,"mouseover",function(){\n'
        +'	this.setOptions({strokeOpacity: "0.8",fillOpacity:"0.7"});\n'
		+'});\n'
		+'google.maps.event.addListener(itTanah<?=$tanah->id_aset_tanah?>,"click",function(){\n'
        +'	this.setOptions({strokeOpacity: "0.9",fillOpacity:"0.8"});\n'
        +'	infoTanah<?=$tanah->id_aset_tanah?>.open(map,itTanah<?=$tanah->id_aset_tanah?>);\n'
		+'});\n'
        +'google.maps.event.addListener(itTanah<?=$tanah->id_aset_tanah?>,"mouseout",function(){\n'
        +'	this.setOptions({strokeOpacity: "'+polygonstyles[pcur].lineopac+'",fillOpacity:"'+polygonstyles[pcur].fillopac+'"});\n'
        +'	infoTanah<?=$tanah->id_aset_tanah?>.close(map,itTanah<?=$tanah->id_aset_tanah?>);\n'
        +'});\n'
		
		+ 'var arrayLoc = ' + arrayLoc +';'
		;
        
        placemarks[plmcur].poly = "pg";
    }
    javacode = gob('coords1').value;
}


</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/maps/nganu.js"></script>
<script>
function nav_active(){
	document.getElementById("a-tanah").className = "collapsed active";
}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});

</script>  
<link href="<?php echo base_url(); ?>assetku/maps/style.css" rel="stylesheet">

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
		
	<div class="col-md-12">
		<input type="button" class="btn btn-default" onclick="clearMap();" value="Bersihkan Peta"/>
		<input type="button" class="btn btn-default" onclick="deleteLastPoint();" value="Hapus Titik Terakhir"/>
		<input type="button" class="btn btn-default" onclick="editlines();" value="Membaikkan Garis" id="EditButton"/>	
		<h5 style="float:right; "><b>No. Sertifikat : <?= $tanah->no_sertifikat?></b></h5>							
		<br>
		<br>
		<legend></legend>
	</div>
	
	<?php
	$attributes = array('name' => 'myform');
	echo form_open_multipart('peta/c_petaTanah/simpan_peta', $attributes); 
	?>

	<input type="hidden" value="<?= $tanah->id_aset_tanah?>" name="id_aset_tanah"/>  

	<div class="form-group">
		<label class="col-md-0 control-label" for="simpan"></label>
		<div class="col-md-9">
			<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
			<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>peta/c_petaTanah'"/>
		</div>
	</div>
	<div id="presenter">
		<form action="#">
		<input type="checkbox" style="visibility:hidden; margin-top:-200px;" name="showcodemode" id="presentcode" value="yes" onclick="showCodeintextarea();" checked="checked"/>
		<textarea id="coords1" style="visibility:hidden; margin-top:-200px;" name="lokasi" ></textarea>
		</form>
	</div>
	<?php echo form_close(); ?>
		
</div>
<!-- /.row -->

<div class="col-md-12">					  
	<div class="choice">
		<form id="tools"  action="./" method="post" onsubmit="return false">
		<select id="toolchoice" name="toolchoice" onchange="toolID=parseInt(this.options[this.selectedIndex].value);setTool();">
		<option selected="selected" value="1">Polyline</option>
		<option  value="2">Polygon</option>
		<option value="3">Rectangle</option>
		<option value="4">Circle</option>
		<option value="5">Marker</option>
		<option value="6">Directions</option>
		</select>
		</form>
	</div>
	<div class="choice">
		<form id="codes"  action="./" method="post" onsubmit="return false">
		<select id="codechoice" name="codechoice" onchange="codeID=parseInt(this.options[this.selectedIndex].value);setCode();">
		<option value="1">KML</option>
		<option selected="selected" value="2">Javascript</option>
		</select>
		</form>
	</div>		
</div>	


<div id="polygonstuff">
    <div>
        <a style="padding-left:5px; color: #ffffff;" href="javascript:holecreator()">Hole</a>
    </div>
    <div id="stepdiv" style="padding-left:5px">
        Step 0
    </div>
    <div>
        <input id="multipleholes" type="button" onclick="nexthole();" value="Next hole"/>
    </div>
</div>

<div id="polylineoptions">
    <div style="padding-top:5px; margin-bottom:10px;">
        <div style="float:left;" class="styletitle">POLYLINE</div>
        <div style="float:right;"><a class="closebutton" href="javascript:closethis('polylineoptions')">X</a></div>
    </div>
    <div class="clear"></div>
    <div style="float:left; padding-left:5px; width:230px">
        <form id="style1" style="padding-bottom:1px;" action="./" method="post" onsubmit="return false">
        <div class="label">strokeColor</div>
        <input class="input" type="text" name="color" id="polylineinput1" />
        <div class="clear"></div>
        <div class="label">strokeOpacity</div>
        <input class="input" type="text" name="opacity" id="polylineinput2" />
        <div class="clear"></div>
        <div class="label">strokeWeight</div>
        <input class="input" type="text" name="weight" id="polylineinput3" />
        <div class="clear"></div>
        <div class="label">Style id</div>
        <input class="inputlong" type="text" name="styleid" id="polylineinput4" />
        </form>
    </div>
    <div class="clear"></div>
    <div>
        <a class="oklink" href="javascript:polylinestyle(0)">Click here to save style changes</a>
    </div>
    <div style="margin-top:5px">
        <a class="oklink" href="javascript:polylinestyle(1)">Click here to save as new style</a>
    </div>
    <div style="width:100%; text-align:center; margin-top:5px">
        <input type="button" class="buttons" name="backwards" id="backwards" value="Previous" onclick="stepstyles(-1);"/>
         Style <span id="stylenumberl">1 </span>
        <input type="button" class="buttons" name="forwards" id="forwards" value="Next" onclick="stepstyles(1);"/>
    </div>
</div>
<div id="polygonoptions">
    <div style="padding-top:5px; margin-bottom:10px;">
        <div style="float:left;" class="styletitle">POLYGON/RECTANGLE</div>
        <div style="float:right;"><a class="closebutton" href="javascript:closethis('polygonoptions')">X</a></div>
    </div>
    <div class="clear"></div>
    <div style="float:left; padding-left:5px; width:230px">
        <form id="style2" style="padding-bottom:1px;" action="./" method="post" onsubmit="return false">
        <div class="label">strokeColor</div>
        <input class="input" type="text" name="color" id="polygoninput1" />
        <div class="clear"></div>
        <div class="label">strokeOpacity</div>
        <input class="input" type="text" name="opacity" id="polygoninput2" />
        <div class="clear"></div>
        <div class="label">strokeWeight</div>
        <input class="input" type="text" name="weight" id="polygoninput3" />
        <div class="clear"></div>
        <div class="label">fillColor</div>
        <input class="input" type="text" name="fillcolor" id="polygoninput4" />
        <div class="clear"></div>
        <div class="label">fillOpacity</div>
        <input class="input" type="text" name="fillopacity" id="polygoninput5" />
        <div class="clear"></div>
        <div class="label">Style id</div>
        <input class="inputlong" type="text" name="styleid" id="polygoninput6" />
        </form>
    </div>
    <div class="clear"></div>
    <div>
        <a class="oklink" href="javascript:polygonstyle(0)">Click here to save style changes</a>
    </div>
    <div style="margin-top:5px">
        <a class="oklink" href="javascript:polygonstyle(1)">Click here to save as new style</a>
    </div>
    <div style="width:100%; text-align:center; margin-top:5px">
        <input type="button" class="buttons" name="backwards" id="backwards" value="Previous" onclick="stepstyles(-1);"/>
         Style <span id="stylenumberp">1 </span>
        <input type="button" class="buttons" name="forwards" id="forwards" value="Next" onclick="stepstyles(1);"/>
    </div>
</div>

<div id="circleoptions">
    <div style="padding-top:5px; margin-bottom:10px;">
        <div style="float:left;" class="styletitle">CIRCLE</div>
        <div style="float:right;"><a class="closebutton" href="javascript:closethis('circleoptions')">X</a></div>
    </div>
    <div class="clear"></div>
    <div style="float:left; padding-left:5px; width:250px">
        <form id="rect" style="padding-bottom:1px;" action="./" method="post" onsubmit="return false">
        <div class="label">strokeColor</div>
        <input class="input" type="text" name="color" id="circinput1" />
        <div class="clear"></div>
        <div class="label">strokeOpacity</div>
        <input class="input" type="text" name="opacity" id="circinput2" />
        <div class="clear"></div>
        <div class="label">strokeWeight</div>
        <input class="input" type="text" name="weight" id="circinput3" />
        <div class="clear"></div>
        <div class="label">fillColor</div>
        <input class="input" type="text" name="fillcolor" id="circinput4" />
        <div class="clear"></div>
        <div class="label">fillOpacity</div>
        <input class="input" type="text" name="fillopacity" id="circinput5" />
        <div class="clear"></div>
        <div class="label">Style id</div>
        <input class="inputlong" type="text" name="styleid" id="circinput6" />
        </form>
    </div>
    <div class="clear"></div>
    <div>
        <a class="oklink" href="javascript:circlestyle(0)">Click here to save style changes</a>
    </div>
    <div style="margin-top:5px">
        <a class="oklink" href="javascript:circlestyle(1)">Click here to save as new style</a>
    </div>
    <div style="width:100%; text-align:center; margin-top:5px">
        <input type="button" class="buttons" name="backwards" id="backwards" value="Previous" onclick="stepstyles(-1);"/>
         Style <span id="stylenumberc">1 </span>
        <input type="button" class="buttons" name="forwards" id="forwards" value="Next" onclick="stepstyles(1);"/>
    </div>
</div>
<div id="markeroptions">
    
    <div id="stylestext">
        <form action="#" style="padding-top:3px; margin-top:-5px">
            <div style="float:left;" class="styletitle">MARKER</div>
            <div style="float:right;"><a class="closebutton" href="javascript:closethis('markeroptions')">X</a></div>
            <div class="clear"></div>
            <div><br />
                &lt;Style id =<input type="text" id="st1" value="markerstyle" style="width:100px; border: 2px solid #ccc;" /><br />
                &nbsp;&nbsp;&lt;Icon&gt;&lt;href&gt;
                <input type="text" id="st2" value="http://maps.google.com/intl/en_us/mapfiles/ms/micons/red-dot.png" style="width:380px; border: 2px solid #ccc;" /><br />
                <span id="currenticon" style="height: 35px"><img src="http://maps.google.com/intl/en_us/mapfiles/ms/micons/red-dot.png" alt="" /></span>
                Use default icon, or choose icon from the chart
                <input style="width:120px; margin-left:8px" type="button" name="button" value="Back to default icon" onclick='iconoptions("http://maps.google.com/intl/en_us/mapfiles/ms/micons/red-dot.png");' />
                <br /><br />
            </div>
            <div style="margin-top:5px">
                <a class="oklink" href="javascript:markerstyle(0)">Click here to save style changes</a>
                <a class="oklink" href="javascript:markerstyle(1)">Click here to save as new style</a>
            </div>
            <div style="width:100%; text-align:center; margin-top:5px">
                <input type="button" class="buttons" name="backwards" value="Previous" onclick="stepstyles(-1);"/>
                 Style <span id="stylenumberm">1 </span>
                <input type="button" class="buttons" name="forwards" value="Next" onclick="stepstyles(1);"/>
            </div>
        </form>
    </div>
</div>
<div id="directionstyles">
    <div style="float:right;"><a class="closebutton" href="javascript:closethis('directionstyles')">X</a></div>
    <div class="clear"></div>
    <div style="width:100%; text-align:center; padding-top:40px">
    <input type="button" class="buttons" name="markerbutton" value="Markerstyles" onclick="toolID=5;styleoptions();"/>
    </div>
    <div style="width:100%; text-align:center; padding-top:15px">
    <input type="button" class="buttons" name="linebutton" value="Linestyles" onclick="toolID=1;styleoptions();"/>
    </div>
</div>
<div id="toppers">
    <form action="#">
    &lt;Document&gt;<br />
    &nbsp;&nbsp;&lt;name&gt;<input type="text" id="doc1" value="My document" style="width:345px; border:2px solid #ccc;" /><br />
    &nbsp;&nbsp;&lt;description&gt;<input type="text" id="doc2" value="Content" style="width:312px; border:2px solid #ccc;" /><br /><br />
    &lt;Placemark&gt;<br />
    &nbsp;&nbsp;&lt;name&gt;<input type="text" id="plm1" value="NAME" style="width:345px; border:2px solid #ccc;" /><br />
    &nbsp;&nbsp;&lt;description&gt;<input type="text" id="plm2" value="YES" style="width:312px; border:2px solid #ccc;" /><br />
    &nbsp;&nbsp;&lt;styleURL&gt;<em> current style</em><br />
    &nbsp;&nbsp;&lt;tessellate&gt;<input type="text" id="plm3" value="1" style="width:20px; border:2px solid #ccc;" />&lt;/tessellate&gt;
    &lt;altitudemode&gt;<input type="text" id="plm4" value="clampToGround" style="width:100px; border:2px solid #ccc;" /><br /><br />
    You may create or change styles with the "Style Options" button.<br />
    You may press it now or anytime.<br /><br />
    <input type="button" name="docu" id="docu" value="Save" onclick='savedocudetails();document.getElementById("toppers").style.visibility = "hidden";'/>
    <input type="button" value="Close" onclick='document.getElementById("toppers").value="";document.getElementById("toppers").style.visibility = "hidden";'/>
    </form>
</div>
<div id="dirtoppers">
    <form action="#">
    &lt;Document&gt;<br />
    &nbsp;&nbsp;&lt;name&gt;<input type="text" id="dirdoc1" value="My document" style="width:345px; border:2px solid #ccc;" /><br />
    &nbsp;&nbsp;&lt;description&gt;<input type="text" id="dirdoc2" value="Content" style="width:312px; border:2px solid #ccc;" /><br /><br />
    &lt;Placemark&gt;&nbsp;for line<br />
    &nbsp;&nbsp;&lt;name&gt;<input type="text" id="dirplm1" value="NAME" style="width:345px; border:2px solid #ccc;" /><br />
    &nbsp;&nbsp;&lt;description&gt;<input type="text" id="dirplm2" value="YES" style="width:312px; border:2px solid #ccc;" /><br />
    &nbsp;&nbsp;&lt;styleURL&gt;<em> current style</em><br />
    &nbsp;&nbsp;&lt;tessellate&gt;<input type="text" id="dirplm3" value="1" style="width:20px; border:2px solid #ccc;" />&lt;/tessellate&gt;
    &lt;altitudemode&gt;<input type="text" id="dirplm4" value="clampToGround" style="width:100px; border:2px solid #ccc;" /><br /><br />
    &lt;Placemark&gt;&nbsp;for marker<br />
    &nbsp;&nbsp;&lt;name&gt;<input type="text" id="dirplm5" value="NAME" style="width:345px; border:2px solid #ccc;" /><br />
    &nbsp;&nbsp;&lt;description&gt;<input type="text" id="dirplm6" value="YES" style="width:312px; border:2px solid #ccc;" /><br />
    &nbsp;&nbsp;&lt;styleURL&gt;<em> current style</em><br />
    You may create or change styles with the "Style Options" button.<br />
    You may press it now or anytime in Directions mode.<br /><br />
    <input type="button" name="docu" id="docu" value="Save" onclick='savedocudetails();document.getElementById("dirtoppers").style.visibility = "hidden";'/>
    <input type="button" value="Close" onclick='document.getElementById("dirtoppers").value="";document.getElementById("dirtoppers").style.visibility = "hidden";'/>
    </form>
</div>
<div class="clear"></div>