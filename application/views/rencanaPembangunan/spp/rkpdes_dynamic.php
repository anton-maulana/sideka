
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_rkpdes">Program RKPDes <label style="color:red;"> *</label></label>
		<div class="col-md-9">
			<span class="help-block">
			
			 <?php $id_rkpdes = 'id="id_rkpdes" class="form-control" required disabled';
				echo form_dropdown('id_rkpdes',$rkpdes,'',$id_rkpdes)?> 
		<?php echo form_error('id_rkpdes', '<p class="field_error">','</p>')?>	
			</span>

		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_tahun_anggaran">Tahun Anggaran <label style="color:red;"> *</label></label>
		<div class="col-md-9">
			<span class="help-block">
			
			 <?php $id_tahun_anggaran = 'id="id_tahun_anggaran" class="form-control" required disabled';
				echo form_dropdown('id_tahun_anggaran',$tahun_anggaran,'',$id_tahun_anggaran)?> 
		<?php echo form_error('id_tahun_anggaran', '<p class="field_error">','</p>')?>	
			</span>
			
		</div>
	</div>
	
<script>
$("#id_rkpdes").change(function(){
		var id_rkpdes = {id_rkpdes:$("#id_rkpdes").val()};
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('rencanaPembangunan/c_spp/getTahunAnggaran/')?>",
				data: id_rkpdes,
				success: function(tes){
					$('#lala').html(tes);
				}
			});
        });	
</script>