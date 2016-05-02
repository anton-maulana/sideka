<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>
		
<?php echo form_open('rencanaPembangunan/c_rkpdes/update_rkpdes'); ?>
	<input type="hidden" name="id_rkpdes" id="id_rkpdes" value="<?= $rkpdes->id_rkpdes ?>" size="20" />
	<input type="hidden" name="id_parent_rkpdes" id="id_parent_rkpdes" value="<?= $rkpdes->id_parent_rkpdes ?>" size="20" />
	<input type="hidden" name="id_top_rkpdes" id="id_top_rkpdes" value="<?= $rkpdes->id_top_rkpdes ?>" size="20" />
	<legend></legend>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_rpjmdes">Program RPJMDes <label style="color:red;"> *</label></label>
		<div class="col-md-9">
			<span class="help-block">
			 <?php $id_rpjmdes = 'id="id_rpjmdes" class="form-control" required';
					echo form_dropdown('id_rpjmdes',$rpjmdes,$rkpdes->id_rpjmdes,$id_rpjmdes)?> 
			<?php echo form_error('id_rpjmdes', '<p class="field_error">','</p>')?>	
			</span>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="id_tahun_anggaran">Tahun Anggaran<label style="color:red;"> *</label></label>
		<div class="col-md-9">
			<span class="help-block">
				<div id="lala">
					<?php $id_tahun_anggaran = 'id="id_tahun_anggaran" class="form-control" required';
							echo form_dropdown('id_tahun_anggaran',$tahun_anggaran,$rkpdes->id_tahun_anggaran,$id_tahun_anggaran)?> 
					<?php echo form_error('id_tahun_anggaran', '<p class="field_error">','</p>')?>	
				</div>
			</span>
		</div>
	</div>

	<!--
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_bidang">Bidang*</label>
		<div class="col-md-9">
			<span class="help-block">
			 <?php $id_bidang = 'id="id_bidang" class="form-control" required';
					echo form_dropdown('id_bidang',$bidang,'',$id_bidang)?> 
			<?php echo form_error('id_bidang', '<p class="field_error">','</p>')?>	
			</span>
		</div>
	</div>
	-->
	
	<legend></legend>
	<div class="form-group">
			 <label class="col-md-3 control-label" for="kode_deskripsi_bidang">Pencarian Bidang <label style="color:red;"> *</label></label> 
			 <div class="col-md-9">
			 <span class="help-block">
			 <input type="text" placeholder="<?= $bidang->kode_bidang.' - '.$bidang->deskripsi ?>" class="form-control" name="kode_deskripsi_bidang" id="kode_deskripsi_bidang" size="50" placeholder="Kode Bidang / Deskripsi"  /> 
			</span>
			<legend></legend>
			 </div>
		</div>
		
		<div class="form-group">
			 <label class="col-md-3 control-label" for="kode_bidang">Kode Bidang <label style="color:red;"> *</label></label> 
			 <div class="col-md-9">
			 <span class="help-block">
				<input value="<?= $bidang->kode_bidang ?>" id="kode_bidang_sementara" name="kode_bidang_sementara" type="text" placeholder="Kode Bidang" class="form-control input-md" required="" disabled/>
				<input value="<?= $bidang->kode_bidang ?>" type="hidden" class="form-control input-md" name="kode_bidang" id="kode_bidang" /> 
			</span>
			 </div>
		</div>
		
		<div class="form-group">
			 <label class="col-md-3 control-label" for="deskripsi_bidang">Deskripsi <label style="color:red;"> *</label></label> 
			 <div class="col-md-9">
			 <span class="help-block">
				<input value="<?= $bidang->deskripsi ?>" id="deskripsi_sementara" name="deskripsi_sementara" type="text" placeholder="Deskripsi" class="form-control input-md" required="" disabled/>
				<input value="<?= $bidang->deskripsi ?>" type="hidden" class="form-control input-md" name="deskripsi_bidang" id="deskripsi_bidang" size="50"  /> 
			</span>
			 </div>
			<?php echo form_error('nama_ayah', '<p class="field_error">','</p>')?>	
	<legend></legend>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="program"> Program RKPDes <label style="color:red;"> *</label></label> 
		<div class="col-md-9">
			<span class="help-block">
				<input value="<?= $rkpdes->program ?>" class="form-control input-md" type="text" name="program" id="program" placeholder="Program RKPDes"  /> 
			</span>
		</div>
	</div>	
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="indikator"> Indikator</label> 
		<div class="col-md-9">
		<span class="help-block">
			<input value="<?= $rkpdes->indikator ?>" class="form-control input-md" type="text" name="indikator" id="indikator" placeholder="Indikator"  /> 
		</span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="kondisi_awal"> Kondisi Awal</label> 
		<div class="col-md-9">
		<span class="help-block">
			<input value="<?= $rkpdes->kondisi_awal ?>" class="form-control input-md" type="text" name="kondisi_awal" id="kondisi_awal" placeholder="Kondisi Awal" size="25" /> 
		</span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="target"> Target</label> 
		<div class="col-md-9">
		<span class="help-block">
			<input value="<?= $rkpdes->target ?>" class="form-control input-md" type="text" name="target" id="target" placeholder="Target" size="25" /> 
		</span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="lokasi"> Lokasi</label> 
		<div class="col-md-9">
		<span class="help-block">
			<input value="<?= $rkpdes->lokasi ?>" class="form-control input-md" type="text" name="lokasi" id="lokasi" placeholder="Lokasi" size="25" /> 
		</span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_coa">Kode Rekening <label style="color:red;"> *</label></label>
		<div class="col-md-9">
			<span class="help-block">
			 <?php $id_coa = 'id="id_coa" class="form-control" required';
					echo form_dropdown('id_coa',$coa,$rkpdes->id_coa,$id_coa)?> 
			<?php echo form_error('id_coa', '<p class="field_error">','</p>')?>	
			</span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3 control-label" for="nominal"> Nominal</label> 
		<div class="col-md-9">
		<span class="help-block">
			<div class="input-group">
				<span class="input-group-addon">
					<span class="fa">Rp&nbsp;</span>
				</span>
				<input value="<?= $rkpdes->nominal ?>" class="form-control input-md" type="number" name="nominal" id="nominal" 
				placeholder="1000000 = Rp 1.000.000,-" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required/>
			</div>
			<?php echo form_error('nominal', '<p class="field_error">','</p>')?>	
		</span>
		</div>
	</div>
	
	<legend></legend>
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_sumber_dana">Sumber Dana <label style="color:red;"> *</label></label>
		<div class="col-md-9">
			<span class="help-block">
			 <?php $id_sumber_dana = 'id="id_sumber_dana" class="form-control" required';
					echo form_dropdown('id_sumber_dana',$sumber_dana,$rkpdes->id_sumber_dana,$id_sumber_dana)?> 
			<?php echo form_error('id_sumber_dana', '<p class="field_error">','</p>')?>	
			</span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="nominal_sumber_dana"> Nominal Sumber Dana</label> 
		<div class="col-md-9">
		<span class="help-block">
			<div class="input-group">
				<span class="input-group-addon">
					<span class="fa">Rp&nbsp;</span>
				</span>	
				<div id="lala1">
					<input value="<?= $sumber_dana1->nominal ?>" class="form-control input-md" type="text" name="nominal_sumber_dana" id="nominal_sumber_dana"  readonly/>
				</div>
			</div>
			<?php echo form_error('nominal_sumber_dana', '<p class="field_error">','</p>')?>	
		</span>
		</div>
	</div>
	
	
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="sisa_sumber_dana"> Sisa Sumber Dana</label> 
		<div class="col-md-9">
		<span class="help-block">
			<div class="input-group">
				<span class="input-group-addon">
					<span class="fa">Rp&nbsp;</span>
				</span>
				<input value="<?= $sumber_dana1->nominal ?>" placeholder="( Nominal Sumber Dana - Nominal )" value="" class="form-control input-md" type="text" name="sisa_sumber_dana" id="sisa_sumber_dana"  readonly/>
			</div>
			<?php echo form_error('sisa_sumber_dana', '<p class="field_error">','</p>')?>	
		</span>
		</div>
	</div>
	
<p>
	<legend></legend>
	<input type="submit" value="Simpan" class="btn btn-success" id="simpan"/>
	<?php 
	if(!$rkpdes->id_top_rkpdes == null)
	{
	?>
	<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_rkpdes/show_detail_program/<?= $rkpdes->id_top_rkpdes; ?>'"/>
	<?php
	}
	else
	{
	?>
	<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_rkpdes/'"/>
	<?php
	}
	?>
</p>

<?php echo form_close(); ?>




<script>
function nav_active(){
	
	document.getElementById("a-data-perencanaan").className = "collapsed active";
	document.getElementById("perencanaan").className = "collapsed active";
	
	document.getElementById("a-data-rkpdes").className = "collapsed active";
	document.getElementById("rkpdes").className = "collapsed active";

	var d = document.getElementById("nav-list_rkpdes");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});

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

$("#id_rpjmdes").change(function(){
		var id_rpjmdes = {id_rpjmdes:$("#id_rpjmdes").val()};
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('rencanaPembangunan/c_rkpdes/getTahunAnggaran/')?>",
				data: id_rpjmdes,
				success: function(tes){
					$('#lala').html(tes);
				}
			});
        });

var $sisa_sumber_dana = $("#sisa_sumber_dana");	
$("#nominal").keyup(function() {
    var value = parseFloat($("#nominal").val());
    var value2 = parseFloat($("#nominal_sumber_dana").val());
    $sisa_sumber_dana.val(value2 - value);
});	

$("#id_sumber_dana").change(function(){
var id_sumber_dana = {id_sumber_dana:$("#id_sumber_dana").val()};
$.ajax({
		type: "POST",
		url : "<?php echo site_url('rencanaPembangunan/c_rkpdes/GetNominalSumberDana/')?>",
		data: id_sumber_dana,
		success: function(tes){
			$('#lala1').html(tes);
			var value = parseFloat($("#nominal").val());
			var value2 = parseFloat($("#nominal_sumber_dana").val());
			$sisa_sumber_dana.val(value2 - value);
		}
	});
	
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

</script>
