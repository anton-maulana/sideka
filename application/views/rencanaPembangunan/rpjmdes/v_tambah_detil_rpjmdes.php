<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>
<legend></legend>

<div class="alert alert-warning" for="=">
Mohon untuk diperhatikan, bagi isian data yang diberikan tanda <b><label style="color:red;">( * ) </label> wajib diisi.</b><br>
</div>
<legend></legend>
<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>
		
<?php echo form_open('rencanaPembangunan/c_rpjmdes/simpan_detail_rpjmdes/'); ?>

	<input type="hidden" name="id_rpjmdes" id="id_rpjmdes" value="<?= $rpjmdes->id_rpjmdes ?>" size="20" />
	<input type="hidden" name="id_parent_rpjmdes" id="id_parent_rpjmdes" value="<?= $rpjmdes->id_parent_rpjmdes ?>" size="20" />
	<input type="hidden" name="id_top_rpjmdes" id="id_top_rpjmdes" value="<?= $rpjmdes->id_top_rpjmdes ?>" size="20" />
	<input type="hidden" name="id_rpjmd" id="id_rpjmd" value="<?= $rpjmdes->id_rpjmd ?>" size="20" />
	<input type="hidden" name="id_bidang" id="id_bidang" value="<?= $rpjmdes->id_bidang ?>" size="20" />
	
	<div class="form-group">
		 <label class="col-md-3 control-label" for="id_periode">Periode<label style="color:red;">* </label> </label>
		<div class="col-md-9">
        <span class="help-block">
		 <?php $id_periode = 'id="id_periode" class="form-control" required disabled';
				echo form_dropdown('id_periode',$periode,$rpjmdes->id_periode,$id_periode)?> 
		<?php echo form_error('id_periode', '<p class="field_error">','</p>')?>	
		</span>
		</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="program_rpjmdes"> Program RPJMDes</label> 
        <div class="col-md-9">
        <span class="help-block">
         <input class="form-control input-md" type="text" name="program_rpjmdes" id="program_rpjmdes" value="<?= $rpjmdes->program ?>" size="25" disabled="true"/> 
		</span>
		</div>
	</div>
	<legend></legend>
	
	<div class="form-group">
		 <label class="col-md-3 control-label" for="tahun">Tahun<label style="color:red;"> * </label>  </label>
		<div class="col-md-9">
        <span class="help-block">
		 <?php $tahun = 'id="tahun" class="form-control" required';
				echo form_dropdown('tahun',$tahun_anggaran,$year_now,$tahun)?> 
		<?php echo form_error('tahun', '<p class="field_error">','</p>')?>	
		</span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3 control-label" for="tanggal"> Tanggal</label> 
		<div class="col-md-9">
		<span class="help-block">
			<a href="javascript:NewCssCal('tanggal','ddmmyyyy')">
					<div class="input-group">
							<span class="input-group-addon">
								<span class="fa 
fa-calendar"> </span>
							</span>
							<input type="text" class="form-control" name="tanggal" id="tanggal" size="50" readonly="readonly" placeholder="Tanggal - Bulan - Tahun"/>	
					</div>
				</a>
			<?php echo form_error('tanggal', '<p class="field_error">','</p>')?>	
		</span>
		</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="volume"> Volume<label style="color:red;">* </label> </label> 
        <div class="col-md-9">
        <span class="help-block">
         <input class="form-control input-md" type="text" name="volume" id="volume"  placeholder="Volume" required/> 
		 <?php echo form_error('volume', '<p class="field_error">','</p>')?>	
		</span>
		</div>
	</div>	
	<div class="form-group">
		<label class="col-md-3 control-label" for="satuan"> Harga Satuan<label style="color:red;"> * </label> </label> 
		<div class="col-md-9">
		<span class="help-block">
			<input class="form-control input-md" type="text" name="satuan" id="satuan" placeholder="Harga Satuan" required/> 
			<?php echo form_error('satuan', '<p class="field_error">','</p>')?>	
		</span>
		</div>
	</div>
	

	
	<div class="form-group">
		<label class="col-md-3 control-label" for="lokasi"> Lokasi</label> 
		<div class="col-md-9">
		<span class="help-block">
			<input class="form-control input-md" type="text" name="lokasi" id="lokasi" size="25"  placeholder="Lokasi" required/> 
			<?php echo form_error('lokasi', '<p class="field_error">','</p>')?>	
		</span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3 control-label" for="nominal"> Nominal</label> 
		<div class="col-md-9">
		<span class="help-block">
			<div class="input-group">
				<span class="input-group-addon">
					<span class="fa">Rp</span>
				</span>
				<input class="form-control input-md" type="text" value="" name="nominal" id="nominal" placeholder="( Volume  x  Satuan )"
				onkeypress='return event.charCode >= 48 && event.charCode <= 57' required/>
			</div>
			<?php echo form_error('nominal', '<p class="field_error">','</p>')?>	
		</span>
		</div>
	</div>
	
	
	
	
	
<p>
	<legend></legend>
	<input type="submit" value="Simpan" class="btn btn-success" id="simpan"/>
	<?php 
	if(!$rpjmdes->id_top_rpjmdes == null)
	{
	?>
		<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_rpjmdes/show_detail_rpjmdes/<?= $rpjmdes->id_top_rpjmdes; ?>'"/>
	<?php
	}
	else
	{
	?>
		<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_rpjmdes/show_detail_rpjmdes/<?= $rpjmdes->id_rpjmdes; ?>'"/>
	<?php
	}
	?>
</p>

<?php echo form_close(); ?>



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

var $nominal = $("#nominal");	
$("#volume").keyup(function() {
    var value = parseFloat($("#volume").val());
    var value2 = parseFloat($("#satuan").val());
    $nominal.val(value2 * value);
});	
	
$("#satuan").keyup(function() {
    var value = parseFloat($("#volume").val());
    var value2 = parseFloat($("#satuan").val());
    $nominal.val(value * value2);
});	
</script>