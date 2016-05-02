<?php
$attention_message = isset($attention_message) && $attention_message ? $attention_message : FALSE;
$controller_name = isset($controller_name) ? $controller_name : 'c_rkp';
$arr_provinsi = isset($arr_provinsi) ? $arr_provinsi : FALSE;
$post_data = isset($post_data) && !empty($post_data) && $post_data ? $post_data : FALSE;


$master_rkp = isset($master_rkp) ? $master_rkp : FALSE;


$top_level_coa = isset($top_level_coa) ? $top_level_coa : FALSE;


$id_m_rancangan_rpjm_desa = isset($id_m_rancangan_rpjm_desa) ? $id_m_rancangan_rpjm_desa : '';
$form_url = 'rencanaPembangunan/'.$controller_name.'/add/' . ($post_data ? $post_data["id_m_apbdes"] : '');
?>

<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>

<?php
echo $attention_message ? '<p class="message">' . $attention_message . '</p>' : '';
?>

<?php echo form_open_multipart($form_url, array('id' => 'frmTambahMasterAPBDES')); ?>
<legend></legend>

<?php
//var_dump($post_data);exit;


?>
<div class="form-group">
    <label class="col-md-3 control-label" for="id_m_master_rkp"> Tahun Anggaran *</label> 
    <div class="col-md-9">

        <select  class="form-control input-md required" id="slc_rkp" name="id_m_rkp"  aria-describedby="hlpBlock3">
            <?php if ($master_rkp): ?>
                <?php foreach ($master_rkp as $id_m_master_rkp => $record_master_rkp): ?>
                    <option value="<?php echo $id_m_master_rkp; ?>" <?php echo $post_data && $id_m_master_rkp == $post_data["id_m_rkp"] ? "selected=\"selected\"" : ""; ?>><?php echo 'TA. ' . $record_master_rkp['rkp_tahun']; ?></option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="">-- Tidak ada RKP ditemukan --</option>
            <?php endif; ?>
        </select>

        <span id="hlpBlock3" class="help-block">
            <div id="dvAlertslc_rkp" class="dvAlert">
                <?php if (!$master_rkp): ?>
                    Tidak ada RKP ditemukan untuk tahun anggaran saat ini.
                <?php endif; ?>
            </div>
        </span>
    </div>
</div>
<legend></legend>

<div class="form-group">
    <label class="col-md-3 control-label" for="disetujui_oleh"> Disetujui Oleh *</label> 
    <div class="col-md-9">
        <input class="form-control input-md required" type="text" name="disetujui_oleh" id="disetujui_oleh" size="80" value="<?php echo $post_data ? $post_data["disetujui_oleh"] : ''; ?>"  aria-describedby="hlpBlock7" /> 
        <span id="hlpBlock7" class="help-block">
            <div id="dvAlertdisetujui_oleh" class="dvAlert"></div>
        </span>
    </div>
</div>
<legend></legend>


<div class="form-group">
    <label class="col-md-3 control-label" for="tanggal_disetujui"> Tanggal disetujui </label> 
    <div class="col-md-9">
        <input class="form-control input-md required" type="text" name="tanggal_disetujui" id="tanggal_disetujui" size="80" value="<?php echo $post_data ? $post_data["tanggal_disetujui"] : ''; ?>" aria-describedby="hlpBlock9" /> 
        <span id="hlpBlock9" class="help-block">
            <div id="dvAlerttanggal_disetujui" class="dvAlert"></div>
        </span>
    </div>
</div>
<p>
<legend></legend>
<input type="submit" value="Simpan" class="btn btn-success" id="simpan"/>
<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href = '<?php echo base_url(); ?>rencanaPembangunan/c_apbdes'" />
</p>

<?php echo form_close(); ?>

<?php
echo isset($js_general_helper) ? $js_general_helper : '';
?>
<script>
    function nav_active() {

        document.getElementById("a-data-perencanaan").className = "collapsed active";
        document.getElementById("perencanaan").className = "collapsed active";

        document.getElementById("a-data-apb_desa").className = "collapsed active";
    }

// very simple to use!
    $(document).ready(function () {
        nav_active();

        $("#simpan").click(function () {
            ResetValidationMessage();

            var validation_a = ValidateInput("slc_rkp", "dvAlertslc_rkp", "Harus Memilih Tahun Anggaran dari RKP terlebih dahulu"),
            validation_b = ValidateInput("disetujui_oleh", "dvAlertdisetujui_oleh", "Disetujui Oleh harus diisi"),
            formvalid = validation_a && validation_b;

            if (formvalid) {
                if (confirm("Mohon tetap di halaman ini ketika proses sedang berjalan.\nProses Akan berhenti ketika anda berpindah halaman.Hendaknya memeriksa kembali sebelum melakukan simpan data.\n\nAnda yakin akan melanjutkan ? ")) {
                    $(this).attr("disabled", true);
                    $(this).attr("value", "Tunggu .. ");

                    $("#batal").attr("disabled", true);

                    $("#frmTambahMasterAPBDES").submit();
                }
            }
            return false;
        });


        $("#tanggal_disetujui").datepicker({dateFormat: 'dd-mm-yy'});

    });
</script>