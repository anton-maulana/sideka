<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>
		
<?php echo form_open_multipart('rencanaPembangunan/c_rpjmdes/simpan_rpjmdes/'); ?>

	<legend></legend>
<div class="alert alert-warning" for="=">
Mohon untuk diperhatikan, bagi isian data yang diberikan tanda <b><label style="color:red;">( * ) </label> wajib diisi.</b><br>
</div>
	<legend></legend>
	<div class="form-group">
		 <label class="col-md-3 control-label" for="id_periode">Periode <label style="color:red;"> *</label></label>
		<div class="col-md-9">
        <span class="help-block">
		 <?php $id_periode = 'id="id_periode" class="form-control" required';
				echo form_dropdown('id_periode',$periode,'',$id_periode)?> 
		
		<?php echo form_error('id_periode', '<p class="field_error">','</p>')?>	
		</span>
		</div>
	</div>
	<legend></legend>
	<div class="form-group">
			 <label class="col-md-3 control-label" for="kode_deskripsi_bidang">Pencarian Bidang <label style="color:red;"> *</label></label> 
			 <div class="col-md-9">
			 <span class="help-block">
			 <input type="text" class="form-control" name="kode_deskripsi_bidang" id="kode_deskripsi_bidang" size="50" placeholder="Kode Bidang / Deskripsi"  /> 
			</span>
			<legend></legend>
			 </div>
		</div>
		
		<div class="form-group">
			 <label class="col-md-3 control-label" for="kode_bidang">Kode Bidang <label style="color:red;"> *</label></label> 
			 <div class="col-md-9">
			 <span class="help-block">
				<input id="kode_bidang_sementara" name="kode_bidang_sementara" type="text" placeholder="Kode Bidang" class="form-control input-md" required="" disabled/>
				<input type="hidden" class="form-control input-md" name="kode_bidang" id="kode_bidang" size="50"  /> 
			</span>
			 </div>
		</div>
		
		<div class="form-group">
			 <label class="col-md-3 control-label" for="deskripsi_bidang">Deskripsi <label style="color:red;"> *</label></label> 
			 <div class="col-md-9">
			 <span class="help-block">
				<input id="deskripsi_sementara" name="deskripsi_sementara" type="text" placeholder="Deskripsi" class="form-control input-md" required="" disabled/>
				<input type="hidden" class="form-control input-md" name="deskripsi_bidang" id="deskripsi_bidang" size="50"  /> 
			</span>
			 </div>
			<?php echo form_error('nama_ayah', '<p class="field_error">','</p>')?>	
		<legend></legend>
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_rpjmd">Program RPJMD <label style="color:red;"> *</label></label>
		<div class="col-md-9">
			<span class="help-block">
			 <?php $id_rpjmd = 'id="id_rpjmd" class="form-control" required';
					echo form_dropdown('id_rpjmd',$rpjmd,'',$id_rpjmd)?> 
			<?php echo form_error('id_rpjmd', '<p class="field_error">','</p>')?>	
			</span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3 control-label" for="program"> Program RPJMDes <label style="color:red;"> *</label></label> 
		<div class="col-md-9">
			<span class="help-block">
				<input class="form-control input-md" type="text" name="program" id="program" size="25" /> 
			</span>
		</div>
	</div>	
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="indikator"> Indikator <label style="color:red;"> *</label></label> 
		<div class="col-md-9">
		<span class="help-block">
			<input class="form-control input-md" type="text" name="indikator" id="indikator" size="25" /> 
		</span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="kondisi_awal"> Kondisi Awal </label> 
		<div class="col-md-9">
		<span class="help-block">
			<input class="form-control input-md" type="text" name="kondisi_awal" id="kondisi_awal" size="25" /> 
		</span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="target"> Target</label> 
		<div class="col-md-9">
		<span class="help-block">
			<input class="form-control input-md" type="text" name="target" id="target" size="25" /> 
		</span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="capaian"> Capaian</label> 
		<div class="col-md-9">
		<span class="help-block">
			<input class="form-control input-md" type="text" name="capaian" id="capaian" size="25" /> 
		</span>
		</div>
	</div>
		

<p>
<legend></legend>

	<input type="submit" value="Simpan" class="btn btn-success" id="simpan"/>
	<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_rpjmdes'"/>
</p>

<?php echo form_close(); ?>

<script>	
  $(function() {
    var Bidang = <?php  echo $json_array_bidang; ?> ;
    $("#kode_deskripsi_bidang" ).autocomplete({
      source: Bidang,
	  minLength: 1,
	  select: function(event, ui) {
		
		bits = ui.item.value.split(' - ')
		kode_bidang = bits[bits.length - 2]
		deskripsi_bidang = bits[bits.length - 1]
			$("#kode_bidang").val(kode_bidang);
			$("#deskripsi_bidang").val(deskripsi_bidang);
			$("#kode_bidang_sementara").val(kode_bidang);
			$("#deskripsi_sementara").val(deskripsi_bidang);
        },
        change: function(event, ui) {
		
		bits = ui.item.value.split(' - ')
		kode_bidang = bits[bits.length - 2]
		deskripsi_bidang = bits[bits.length - 1]
			$("#kode_bidang").val(kode_bidang);
			$("#deskripsi_bidang").val(deskripsi_bidang);			
			$("#kode_bidang_sementara").val(kode_bidang);
			$("#deskripsi_sementara").val(deskripsi_bidang);
        }
    });
  });
</script>

<script>
function nav_active(){
	
	document.getElementById("a-data-perencanaan").className = "collapsed active";
	document.getElementById("perencanaan").className = "collapsed active";
	
	document.getElementById("a-data-rpjmdes").className = "collapsed active";
	document.getElementById("rpjmdes").className = "collapsed active";

	var d = document.getElementById("nav-list_rpjmdes");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>