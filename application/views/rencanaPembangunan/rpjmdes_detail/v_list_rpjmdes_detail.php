<link href="<?=$this->config->item('base_url');?>css/flexigrid.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/jquery.pack.js"></script>
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/flexigrid.pack.js"></script>

<div class="col-md-3">
	<ul class="nav navbar-right" style="float:right;"">
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="fa fa-gears fa-fw"></i> Aksi / Tindakan <i class="fa fa-caret-down"> </i>
			</a>
			<ul class="dropdown-menu dropdown-user">
				<li>
					<a href="<?php echo site_url('rencanaPembangunan/c_rpjmdes_detail/export_to_excel/'.$id_periode);?>"><i class="fa fa-print fa-fw"></i> Cetak Excel</a>
				</li>
			</ul>
		</li>
	</ul> 
</div>
<div class="col-md-12">
<legend></legend>

<?php
echo $js_grid;
?>

<table id="flex1" style="display:none"></table>

</div>
<script>
function nav_active(){
	
	document.getElementById("a-data-perencanaan").className = "collapsed active";
	document.getElementById("perencanaan").className = "collapsed active";
	
	document.getElementById("a-data-rpjmdes").className = "collapsed active";
	document.getElementById("rpjmdes").className = "collapsed active";

	var d = document.getElementById("nav-rpjmdes");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>