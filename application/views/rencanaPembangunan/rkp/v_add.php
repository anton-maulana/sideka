<?php
$attention_message = isset($attention_message) && $attention_message ? $attention_message : FALSE;
$controller_name = isset($controller_name) ? $controller_name : 'c_rkp';
$arr_provinsi = isset($arr_provinsi) ? $arr_provinsi : FALSE;
$post_data = isset($post_data) ? $post_data : FALSE;


$master_rpjm = isset($master_rpjm) ? $master_rpjm : FALSE;


$id_m_rancangan_rpjm_desa = isset($id_m_rancangan_rpjm_desa) ? $id_m_rancangan_rpjm_desa : '';
$form_url = 'rencanaPembangunan/c_rkp/add/' . (!empty($post_data) && $post_data ? $post_data["id_m_rkp"] : '');
?>

<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>

<?php
echo $attention_message ? '<p class="message">' . $attention_message . '</p>' : '';
?>

<?php echo form_open_multipart($form_url, array('id' => 'frmTambahMasterRKP')); ?>
<legend></legend>

<div class="form-group">
    <label class="col-md-3 control-label" for="id_provinsi"> RPJM Desa *</label> 
    <div class="col-md-9">
        <?php if ($master_rpjm): ?>
            <select  class="form-control input-md required" id="slc_rpjm" name="id_m_rancangan_rpjm_desa"  aria-describedby="hlpBlock3">
                <?php foreach ($master_rpjm as $id_m_rancangan_rpjm_desa => $record_master_rpjm): ?>
                    <option value="<?php echo $id_m_rancangan_rpjm_desa; ?>" <?php echo!empty($post_data) && $post_data && $id_m_rancangan_rpjm_desa == $post_data["id_m_rancangan_rpjm_desa"] ? "selected=\"selected\"" : ""; ?>><?php echo 'TA. ' . $record_master_rpjm['tahun_anggaran'] . ' - ' . $record_master_rpjm['nama_desa'] . ', ' . $record_master_rpjm['nama_desa'] . ', ' . $record_master_rpjm['nama_kab_kota']; ?></option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
        <span id="hlpBlock3" class="help-block">
            <div id="dvAlertslc_rpjm" class="dvAlert"></div>
        </span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label" for="tahun_anggaran"> Tahun Anggaran *</label> 
    <div class="col-md-9">
        <select  class="form-control required" style="width: 50%;" id="slc_rkp_tahun" name="rkp_tahun" aria-describedby="hlpBlock1">
        </select>
        <span id="hlpBlock1" class="help-block">
            <div id="dvAlertslc_rkp_tahun" class="dvAlert"></div>
        </span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label" for="kepala_desa"> Nama Kepala Desa *</label> 
    <div class="col-md-9">
        <input class="form-control input-md required" type="text" name="kepala_desa" id="kepala_desa" size="80" value="<?php echo $post_data ? $post_data["kepala_desa"] : ''; ?>"  aria-describedby="hlpBlock7" /> 
        <span id="hlpBlock7" class="help-block">
            <div id="dvAlertKepalaDesa" class="dvAlert"></div>
        </span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label" for="disusun_oleh"> Disusun Oleh *</label> 
    <div class="col-md-9">
        <input class="form-control input-md required" type="text" name="disusun_oleh" id="disusun_oleh" size="80" value="<?php echo $post_data ? $post_data["disusun_oleh"] : ''; ?>" aria-describedby="hlpBlock8" /> 
        <span id="hlpBlock8" class="help-block">
            <div id="dvAlertDisusunOleh" class="dvAlert"></div>
        </span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label" for="tanggal_disusun"> Tanggal disusun *</label> 
    <div class="col-md-9">
        <input class="form-control input-md required" type="text" name="tanggal_disusun" id="tanggal_disusun" size="80" value="<?php echo $post_data ? $post_data["tanggal_disusun"] : ''; ?>" aria-describedby="hlpBlock9" /> 
        <span id="hlpBlock9" class="help-block">
            <div id="dvAlertTanggalDisusun" class="dvAlert"></div>
        </span>
    </div>
</div>

<p>
<legend></legend>
<input type="submit" value="Simpan" class="btn btn-success" id="simpan"/>
<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href = '<?php echo base_url(); ?>rencanaPembangunan/c_rkp'" />
</p>

<?php echo form_close(); ?>

<?php
echo isset($js_general_helper) ? $js_general_helper : '';
?>
<script>
    function nav_active() {

        document.getElementById("a-data-perencanaan").className = "collapsed active";
        document.getElementById("perencanaan").className = "collapsed active";

        document.getElementById("a-data-rkp_desa").className = "collapsed active";
    }

    var rpjm_th = [];
<?php if ($master_rpjm): ?>
    <?php foreach ($master_rpjm as $id_m_rancangan_rpjm_desa => $record_master_rpjm): ?>
            rpjm_th.push({"id_rpjm": <?php echo $id_m_rancangan_rpjm_desa; ?>, "tahun_awal": <?php echo $record_master_rpjm['tahun_awal']; ?>, "tahun_akhir": <?php echo $record_master_rpjm['tahun_akhir']; ?>});
    <?php endforeach; ?>
<?php endif; ?>

// very simple to use!
    $(document).ready(function () {

        console.log(rpjm_th);

        nav_active();

        $("#simpan").click(function () {
            ResetValidationMessage();

            var formvalid = ValidateInput("slc_rkp_tahun", "dvAlertslc_rkp_tahun", "Tahun RKP harus diisi");
            formvalid = formvalid && ValidateInput("slc_rpjm", "dvAlertslc_rpjm", "RPJM harus diisi");
            formvalid = formvalid && ValidateInput("kepala_desa", "dvAlertKepalaDesa", "Kepala Desa harus diisi");
            formvalid = formvalid && ValidateInput("disusun_oleh", "dvAlertDisusunOleh", "Disusun oleh harus diisi");
            formvalid = formvalid && ValidateInput("tanggal_disusun", "dvAlertTanggalDisusun", "Tanggal Disusun harus diisi");

            if (formvalid) {
                if (confirm("Mohon tetap di halaman ini ketika proses sedang berjalan.\nProses Akan berhenti ketika anda berpindah halaman.Hendaknya memeriksa kembali sebelum melakukan simpan data.\n\nAnda yakin akan melanjutkan ? ")) {
                    $(this).attr("disabled", true);
                    $(this).attr("value", "Tunggu .. ");

                    $("#batal").attr("disabled", true);

                    $("#frmTambahMasterRKP").submit();
                }
            }
            return false;
        });

        $("#slc_rpjm").change(function () {
            ResetInputSelect($("#slc_rkp_tahun"));
            var val = $(this).val();

            if (val != null && rpjm_th.length > 0) {
                $.each(rpjm_th, function (i, v) {
                    if (v.id_rpjm == val) {
                        var opt = '';
                        for (i = v.tahun_awal; i <= v.tahun_akhir; i++) {
                            opt += '<option value=\'' + i + '\'>' + i + '</option>';
                        }
                        $("#slc_rkp_tahun").append(opt);
                    }
                });
            }

        });

        $("#slc_rpjm").change();

<?php if (!empty($post_data) && $post_data): ?>
        $("#slc_rkp_tahun").val(<?php echo $post_data["rkp_tahun"]; ?>);
<?php endif; ?>

        $("#slc_provinsi").change(function () {
            var val = $(this).val();

            ResetInputSelect($("#slc_kab_kota"));
            ResetInputSelect($("#slc_id_kecamatan"));
            ResetInputSelect($("#slc_desa"));

            if (val != null) {
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/c_kabkota/get_json_array_by_provinsi',
                    data: {
                        id_provinsi: val
                    },
                    method: 'POST',
                    data_type: 'json',
                    success: function (response) {
                        if (response !== 'fail') {
                            var optKota = '';
//                            console.log(response);
                            $.each(response, function (index, option) {
                                optKota += '<option value=\'' + option.id_kab_kota + '\'>' + option.nama_kab_kota + '</option>';
                            });
                            $("#slc_kab_kota").append(optKota);

                            $("#slc_kab_kota").change();
                        }
                    }
                });
            }
        });


        $("#tanggal_disusun").datepicker({dateFormat: 'dd-mm-yy'});

<?php if ($post_data): ?>
            $("#slc_provinsi").val("<?php echo $post_data["id_provinsi"] ?>");
            $("#slc_provinsi").change();

            $("#slc_kab_kota").val("<?php echo $post_data["id_kab_kota"] ?>");
            $("#slc_kab_kota").change();

            $("#slc_id_kecamatan").val("<?php echo $post_data["id_kecamatan"] ?>");
            $("#slc_id_kecamatan").change();

            $("#slc_desa").val("<?php echo $post_data["id_desa"] ?>");
<?php endif; ?>
    });
</script>