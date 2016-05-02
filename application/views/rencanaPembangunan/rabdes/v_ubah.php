<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>
		
<?php echo form_open('rencanaPembangunan/c_rabdes/update_rabdes/'); ?>
<legend></legend>
<div class="alert alert-warning" for="=">
Mohon untuk diperhatikan, bagi isian data yang diberikan tanda <b><label style="color:red;">( * ) </label> wajib diisi.</b><br>
</div>
	<input type="text" name="id_rabdes" id="id_rabdes" value="<?= $rabdes->id_rabdes ?>" size="20" />
<legend></legend>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_rkpdes">Program RKPDes <label style="color:red;"> *</label></label>
		<div class="col-md-9">
			<span class="help-block">
			 <?php $id_rkpdes = 'id="id_rkpdes" class="form-control" required';
					echo form_dropdown('id_rkpdes',$rkpdes,$rabdes->id_rkpdes,$id_rkpdes)?> 
			<?php echo form_error('id_rkpdes', '<p class="field_error">','</p>')?>	
			</span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_tahun_anggaran">Tahun Anggaran <label style="color:red;"> *</label></label>
		<div class="col-md-9">
			<span class="help-block">
			<div id="lala">
			 <?php $id_tahun_anggaran = 'id="id_tahun_anggaran" class="form-control" required disabled';
					echo form_dropdown('id_tahun_anggaran',$tahun,$rabdes->id_tahun_anggaran,$id_tahun_anggaran)?> 
			<?php echo form_error('id_tahun_anggaran', '<p class="field_error">','</p>')?>	
			</span>
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="kegiatan"> Kegiatan RABDes <label style="color:red;"> *</label></label> 
		<div class="col-md-9">
			<span class="help-block">
				<input value="<?= $rabdes->kegiatan ?>" class="form-control input-md" type="text" name="kegiatan" id="kegiatan" placeholder="Kegiatan RABDes" /> 
			</span>
		</div>
	</div>	
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="waktu_pelaksanaan_awal">Waktu Pelaksanaan Awal <label style="color:red;"> *</label></label> 
		<div class="col-md-9">		
			<a href="javascript:NewCssCal('waktu_pelaksanaan_awal','ddmmyyyy')">
			<div class="input-group">
				 <span class="input-group-addon">
					<span class="fa fa-table"></span>
				</span>
				<input value="<?= date('d-m-Y', strtotime($rabdes->waktu_pelaksanaan_awal)) ?>" type="text" class="form-control input-md"  name="waktu_pelaksanaan_awal" id="waktu_pelaksanaan_awal" size="20" readonly="readonly"/>
			</div>	
			</a>
		<span class="help-block">	
			<?php echo form_error('waktu_pelaksanaan_awal', '<p class="field_error">','</p>')?>		
		</span>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="waktu_pelaksanaan_akhir">Waktu Pelaksanaan Akhir <label style="color:red;"> *</label></label> 
		<div class="col-md-9">		
			<a href="javascript:NewCssCal('waktu_pelaksanaan_akhir','ddmmyyyy')">
			<div class="input-group">
							 <span class="input-group-addon">
								<span class="fa fa-table"></span>
							</span>
			<input value="<?= date('d-m-Y', strtotime($rabdes->waktu_pelaksanaan_akhir)) ?>" type="text" class="form-control input-md"  name="waktu_pelaksanaan_akhir" id="waktu_pelaksanaan_akhir" size="20" readonly="readonly"/>
			</div>	
			</a>
		<span class="help-block">	
			<?php echo form_error('waktu_pelaksanaan_awal', '<p class="field_error">','</p>')?>		
		</span>
		</div>
	</div>
	
<p>
<legend></legend>

	<input type="submit" value="Simpan" class="btn btn-success" id="simpan"/>
	<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_rabdes'"/>
</p>

<?php echo form_close(); ?>




<script>
function nav_active(){
	
	document.getElementById("a-data-anggaran").className = "collapsed active";
	document.getElementById("anggaran").className = "collapsed active";
	
	var d = document.getElementById("nav-rabdes");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});

$(document).ready(function() {
    $("#txtboxToFilter").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});

$("#id_rkpdes").change(function(){
		var id_rkpdes = {id_rkpdes:$("#id_rkpdes").val()};
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('rencanaPembangunan/c_rabdes/getTahunAnggaran/')?>",
				data: id_rkpdes,
				success: function(tes){
					$('#lala').html(tes);
				}
			});
        });	
</script>