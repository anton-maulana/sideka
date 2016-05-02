<?php
$attention_message = isset($attention_message) && $attention_message ? $attention_message : FALSE;
?>

<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>

<?php
echo $attention_message ? '<p class="message">' . $attention_message . '</p>' : '';
?>

<?php echo form_open_multipart('rencanaPembangunan/c_rancangan_rpjm_desa/execute_import_excel/', array('id' => 'frmImportExcel')); ?>
<legend></legend>
<div class="form-group">
    <label class="col-md-3 control-label" for="file_excel"> Upload File Rancangan RPJM Desa *</label> 
    <div class="col-md-9">
        <span class="help-block">
            <input class="form-control input-md" type="file" name="file_excel" id="file_excel" size="25" /> 
        </span>
    </div>
</div>

<p>
<legend></legend>
<input type="submit" value="Simpan" class="btn btn-success" id="simpan"/>
<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href = '<?= base_url() ?>rencanaPembangunan/c_rancangan_rpjm_desa'"/>
</p>

<?php echo form_close(); ?>


<script>
    function nav_active() {

        document.getElementById("a-data-perencanaan").className = "collapsed active";
        document.getElementById("perencanaan").className = "collapsed active";

        document.getElementById("a-data-rancangan_rpjm_desa").className = "collapsed active";
        document.getElementById("rancangan_rpjm_desa").className = "collapsed active";

        var d = document.getElementById("nav-list_rancangan_rpjm_desa");
        d.className = d.className + "active";
    }

// very simple to use!
    $(document).ready(function () {
        nav_active();

        $("#simpan").click(function () {
            if (confirm("Mohon tetap di halaman ini ketika proses sedang berjalan.\nProses Akan berhenti ketika anda berpindah halaman.\nAnda yakin akan mengimpor file ini ? ")) {
                $(this).attr("disabled", true);
                $(this).attr("value", "Tunggu .. ");

                $("#batal").attr("disabled", true);
                
                $("#frmImportExcel").submit();
            }
        });

    });
</script>