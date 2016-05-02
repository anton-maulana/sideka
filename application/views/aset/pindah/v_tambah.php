<div class="col-md-9">
<h3><?= $page_title ?></h3>
</div>

<?php
$attributes = array('name' => 'myform');
echo form_open_multipart('aset/c_pindah/pindah_ruangan', $attributes); 
?>
<!-- Form Name -->
	<legend></legend>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="pencarian_aset">Pencarian Data</label>  
	  <div class="col-md-9">
	  <input id="pencarian_aset" name="pencarian_aset" type="text" placeholder="No Aset / Nama Aset" class="form-control input-md">
	  <span class="help-block"></span>  
	  </div>
	</div>
	
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="no_aset">No Aset</label>  
	  <div class="col-md-9">
	  <input id="no_aset_sementara" name="no_aset_sementara" type="text" placeholder="No Aset" class="form-control input-md" required="" disabled>
	  <input id="no_aset" name="no_aset" type="hidden" class="form-control input-md" >
	  <span class="help-block"></span>  
	  </div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="nama_aset">Nama Aset</label>  
	  <div class="col-md-9">
	  <input id="nama_aset_sementara" name="nama_aset_sementara" type="text" placeholder="Nama Aset" class="form-control input-md" required="" disabled >
	  <input id="nama_aset" name="nama_aset" type="hidden" class="form-control input-md" >
	  <span class="help-block"></span>  
	  </div>
	</div>

<legend></legend>
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="no_sertifikat_nama">Pencarian Data</label>  
	  <div class="col-md-9">
	  <input id="pencarian" name="pencarian" type="text" placeholder="Nama Ruangan / Nama Bangunan" class="form-control input-md">
	  <span class="help-block"></span>  
	  </div>
	</div>
	
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="nama_ruangan">Nama Ruangan</label>  
	  <div class="col-md-9">
	  <input id="nama_ruangan_sementara" name="nama_ruangan_sementara" type="text" placeholder="Nama Ruangan" class="form-control input-md" required="" disabled>
	  <input id="nama_ruangan" name="nama_ruangan" type="hidden" class="form-control input-md" >
	  <span class="help-block"></span>  
	  </div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="deskripsi_bangunan">Nama Bangunan</label>  
	  <div class="col-md-9">
	  <input id="deskripsi_bangunan_sementara" name="deskripsi_bangunan_sementara" type="text" placeholder="Nama Bangunan" class="form-control input-md" required="" disabled >
	  <input id="deskripsi_bangunan" name="deskripsi_bangunan" type="hidden" class="form-control input-md" >
	  <span class="help-block"></span>  
	  </div>
	</div>

	
	
	
	<legend></legend>

	<div class="form-group">
		<label class="col-md-0 control-label" for="pindah"></label>
		<div class="col-md-9">
			<input type="submit" value="Pindah" id="pindah" class="btn btn-success"/>
			<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>aset/c_pindah'"/>
		</div>
	</div>

<br>
<?php echo form_close(); ?>
  
<script>	

  $(function() {
	var countOpen = 0;
    var array = <?php  echo $json_array_ruangan; ?> ;
    $("#pencarian" ).autocomplete({
      source: array,
	  minLength: 1,
	  select: function(event, ui) {
		
		bits = ui.item.value.split(' | ')
		nama_bangunan = bits[bits.length - 1]
		nama_ruangan = bits[bits.length - 2]
			$("#nama_ruangan").val(nama_ruangan);
			$("#deskripsi_bangunan").val(nama_bangunan);
			$("#nama_ruangan_sementara").val(nama_ruangan);
			$("#deskripsi_bangunan_sementara").val(nama_bangunan);
			countOpen++;	
			openPindahButton(countOpen);
        },
        change: function(event, ui) {
		
		bits = ui.item.value.split(' | ')
		nama_bangunan = bits[bits.length - 1]
		nama_ruangan = bits[bits.length - 2]
			$("#nama_ruangan").val(nama_ruangan);
			$("#deskripsi_bangunan").val(nama_bangunan);
			$("#nama_ruangan_sementara").val(nama_ruangan);
			$("#deskripsi_bangunan_sementara").val(nama_bangunan);
        }
    });

    var array = <?php  echo $json_array_aset; ?> ;
    $("#pencarian_aset" ).autocomplete({
      source: array,
	  minLength: 1,
	  select: function(event, ui) {
		
		bits = ui.item.value.split(' | ')
		nama_aset = bits[bits.length - 1]
		no_aset = bits[bits.length - 2]
			$("#nama_aset").val(nama_aset);
			$("#no_aset").val(no_aset);
			$("#nama_aset_sementara").val(nama_aset);
			$("#no_aset_sementara").val(no_aset);
			countOpen++;			
			openPindahButton(countOpen);
        },
        change: function(event, ui) {
		
		bits = ui.item.value.split(' | ')
		nama_aset = bits[bits.length - 1]
		no_aset = bits[bits.length - 2]
			$("#nama_aset").val(nama_aset);
			$("#no_aset").val(no_aset);
			$("#nama_aset_sementara").val(nama_aset);
			$("#no_aset_sementara").val(no_aset);
        }
    });
  });
 
 function openPindahButton(nilai)
 {
	if(nilai == 2){	document.getElementById("pindah").disabled = false;	}
 }
  
</script>

<script>
function nav_active(){
	document.getElementById("a-data-aset").className = "collapsed active";
	
	document.getElementById("aset").className = "collapsed";

	var d = document.getElementById("nav-pindah");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
  document.getElementById("pindah").disabled = true;	
});

</script>

