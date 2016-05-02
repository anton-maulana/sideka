
<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>
<legend></legend>
					
	<div class="row">
		<div class="col-md-9">
			<?php $id_periode = 'id="id_periode" class="form-control" style="width: 240px;"';
				echo form_dropdown('id_periode',$periode,'',$id_periode)
			?> 
			<?php echo form_error('id_periode', '<p class="field_error">','</p>')?>	
		</div>

<div id="lala"></div>
<script>
	$("#id_periode").change(function(){
		var id_periode = {id_periode:$("#id_periode").val()};
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('rencanaPembangunan/c_rpjmdes_detail/lists_rpjmdes_detail/id_periode')?>",
				data: id_periode,
				success: function(tes){
					$('#lala').html(tes);
				}
			});
        });
		
		
function nav_active(){
	
	document.getElementById("a-data-perencanaan").className = "collapsed active";
	document.getElementById("perencanaan").className = "collapsed active";
	
	document.getElementById("a-data-rpjmdes").className = "collapsed active";
	document.getElementById("rpjmdes").className = "collapsed active";

	var d = document.getElementById("nav-detail_rpjmdes");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>