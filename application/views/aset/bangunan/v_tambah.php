<div class="col-md-9">
<h3><?= $page_title ?></h3>
</div>
<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php
$attributes = array('name' => 'myform');
echo form_open_multipart('aset/c_bangunan/simpan_bangunan', $attributes); 
?>
<!-- Form Name -->
	<legend></legend>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="no_sertifikat_nama">Pencarian Data</label>  
	  <div class="col-md-9">
	  <input id="pencarian" name="pencarian" type="text" placeholder="No Sertifikat Tanah / Deskripsi Tanah" class="form-control input-md">
	  <span class="help-block"></span>  
	  </div>
	</div>
	
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="no_sertifikat">No Sertifikat</label>  
	  <div class="col-md-9">
	  <input id="no_sertifikat_sementara" name="no_sertifikat_sementara" type="text" placeholder="No Sertifikat Tanah" class="form-control input-md" required="" disabled>
	  <input id="no_sertifikat" name="no_sertifikat" type="hidden" class="form-control input-md" >
	  <span class="help-block"></span>  
	  </div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="deskripsi_tanah">Deskripsi Tanah</label>  
	  <div class="col-md-9">
	  <input id="deskripsi_tanah_sementara" name="deskripsi_tanah_sementara" type="text" placeholder="Deskripsi Tanah" class="form-control input-md" required="" disabled >
	  <input id="deskripsi_tanah" name="deskripsi_tanah" type="hidden" class="form-control input-md" >
	  <span class="help-block"></span>  
	  </div>
	</div>

<legend></legend>
	<div class="form-group">
	<label class="col-md-3 control-label" for="no_imb">Nomor IMB</label>
		<div class="col-md-9">
		<input class="form-control input-md" type="text" name="no_imb" placeholder="contoh: 1107.06534.6693 " id="no_imb" size="30" required />           
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="deskripsi">Nama Bangunan</label>
		<div class="col-md-9">
		<input class="form-control input-md" type="text" name="deskripsi" placeholder="Deskripsi" id="no_imb" size="30" required />        
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="luas">Luas Bangunan</label>
		<div class="col-md-9">
		<input class="form-control input-md" type="text" name="luas" id="luas" placeholder="Ha (contoh: 15.5)" onkeypress='validate(event)' size="30" required /> 
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_kepemilikan_aset">Kepemilikan </label>
        <div class="col-md-9">         
         <?php $id = 'id="id_kepemilikan_aset" class="form-control input-md" required';
				echo form_dropdown('id_kepemilikan_aset',$kepemilikan,'',$id)?>
		 <span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="tgl_bangun">Tanggal Bangun</label> 
        
        <div class="col-md-9">
			<a href="javascript:NewCssCal('ttl','ddmmyyyy')">
			<div class="input-group">
				 <span class="input-group-addon">
					<span class="fa fa-table"></span>
				</span>
				<input class="form-control input-md" type="text" name="tgl_bangun" id="ttl" size="20" readonly="readonly" placeholder="Tgl-Bln-Thn"/>						
			</div>
			<span class="help-block"></span>	
			</a>		
		</div>
	</div>
		

	
	<legend></legend>

	<div class="form-group">
		<label class="col-md-0 control-label" for="simpan"></label>
		<div class="col-md-9">
			<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
			<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>aset/c_bangunan'"/>
		</div>
	</div>

<br>
<?php echo form_close(); ?>
  
<script>	

  $(function() {
    var array = <?php  echo $json_array_nama; ?> ;
    $("#pencarian" ).autocomplete({
      source: array,
	  minLength: 1,
	  select: function(event, ui) {
		
		bits = ui.item.value.split(' | ')
		no_sertifikat = bits[bits.length - 2]
		nama = bits[bits.length - 1]
			$("#no_sertifikat").val(no_sertifikat);
			$("#deskripsi_tanah").val(nama);
			$("#no_sertifikat_sementara").val(no_sertifikat);
			$("#deskripsi_tanah_sementara").val(nama);
        },
        change: function(event, ui) {
		
		bits = ui.item.value.split(' | ')
		no_sertifikat = bits[bits.length - 2]
		nama = bits[bits.length - 1]
           	$("#no_sertifikat").val(no_sertifikat);
			$("#deskripsi_tanah").val(nama);			
			$("#no_sertifikat_sementara").val(no_sertifikat);
			$("#deskripsi_tanah_sementara").val(nama);
        }
    });
  });
  
  $("#no_imb").change(function(){				
				var datanyakk = {no_imb:$("#no_imb").val()};
				$.ajax({
						type: "POST",
						url : "<?php echo site_url('aset/c_bangunan/noImbExist')?>",
						data: datanyakk,
						success: function(data){
							if(data)
							{
								alertify.error('<b>No IMB</b> telah digunakan oleh bangunan yang terdaftar !');
								$("#no_imb").focus();
								document.getElementById("simpan").disabled = true;	
							}
							else
							{
								document.getElementById("simpan").disabled = false;
							}
						}
					});
				
        });
  
</script>

<script>


function nav_active(){
	document.getElementById("a-data-bangunan").className = "collapsed active";
	
	document.getElementById("bangunan").className = "collapsed";

	var d = document.getElementById("nav-bangunan");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});

</script>

