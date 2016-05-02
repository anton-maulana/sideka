<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>
<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>
		
<?php echo form_open('rencanaPembangunan/c_spp/simpan2_spp_detail/'); ?>
<legend></legend>
<div class="alert alert-warning" for="=">
Mohon untuk diperhatikan, bagi isian data yang diberikan tanda <b><label style="color:red;">( * ) </label> wajib diisi.</b><br>
</div>
<input  type="hidden" name="id_spp" id="id_spp" value="<?= $spp->id_spp ?>" /> 
<legend></legend>

<?php foreach($uraian_rabdes_anggaran as $row)
	{
		$tes = explode(" - ", $row);
?>
	<input class="form-control input-md" type="text" name="id_rabdes_anggaran" id="id_rabdes_anggaran" value="<?php echo $tes[0];?>"/> 
	<div class="form-group">
	<label class="col-md-4 control-label"> <?php echo $tes[1];?> <label style="color:red;"> </label></label> 
	<div class="form-group">
		<div class="col-md-8">
			<span class="help-block">
				<input class="form-control input-md" type="text" name="permintaan_sekarang" id="permintaan_sekarang" placeholder="Permintaan Sekarang" /> 
			</span>
		</div>
	</div>
	</div>
<legend></legend>
	
<?php
	}
?>
<input  class="form-control input-md" type="text" name="id_ra" id="id_ra" value="" />
<p>
<legend></legend>
	<input type="submit" value="Simpan" class="btn btn-success" id="simpan"/>
	<input type="button" value="Sebelumnya" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_spp/add_spp_detail/<?= $spp->id_spp ?>'"/>
</p>

<?php echo form_close(); ?>


<script>
function nav_active(){
	
	document.getElementById("a-data-anggaran").className = "collapsed active";
	document.getElementById("anggaran").className = "collapsed active";
	
	var d = document.getElementById("nav-spp");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});



var array = [];
var $id_rabdes_anggaran = $("#id_rabdes_anggaran");	
var $id_ra = $("#id_ra");
var i;
//var uraian = '<?php $uraian_rabdes_anggaran ?>';

temp = $id_rabdes_anggaran.attr("value");

console.log(array);
array.push(temp);
$id_ra.val('['+array+']');

</script>