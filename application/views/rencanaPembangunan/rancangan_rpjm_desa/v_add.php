<?php
$attention_message = isset($attention_message) && $attention_message ? $attention_message : FALSE;
$arr_provinsi = isset($arr_provinsi) ? $arr_provinsi : FALSE;
$post_data = isset($post_data) ? $post_data : FALSE;
$id_m_rancangan_rpjm_desa = isset($id_m_rancangan_rpjm_desa) ? $id_m_rancangan_rpjm_desa : '';
$form_url = 'rencanaPembangunan/c_rancangan_rpjm_desa/add/' . $id_m_rancangan_rpjm_desa;
?>

<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>

<?php
echo $attention_message ? '<p class="message">' . $attention_message . '</p>' : '';
?>

<?php echo form_open_multipart($form_url, array('id' => 'frmTambahMasterRPJM')); ?>
<legend></legend>
<div class="form-group">
    <label class="col-md-3 control-label" for="tahun_anggaran"> Tahun Anggaran*</label> 
    <div class="col-md-9">
        <div class="input-group">
            <?php $tahun_awal = $post_data ? $post_data['tahun_awal'] : date('Y'); ?>
            <select  class="form-control required" style="width: 50%;" id="slc_tahun_anggaran_awal" name="tahun_awal" aria-describedby="hlpBlock1">
                <?php for ($i = $tahun_awal - 8; $i <= $tahun_awal + 8; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php echo $i == $tahun_awal ? 'selected=selected' : ''; ?>><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
            <?php $tahun_akhir = $post_data ? $post_data['tahun_akhir'] : date('Y'); ?>
            <select  class="form-control required" style="width: 50%;" id="slc_tahun_anggaran_akhir" name="tahun_akhir" aria-describedby="hlpBlock2" >
                <?php for ($i = $tahun_akhir - 8; $i <= $tahun_akhir + 8; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php echo $i == $tahun_akhir ? 'selected=selected' : ''; ?>><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
            <span id="hlpBlock1" class="help-block">
                <div id="dvAlertTahunAnggaranAwal" class="dvAlert"></div>
            </span>
        </div>
    </div>
</div>	

<div class="form-group">
    <label class="col-md-3 control-label" for="id_provinsi"> Provinsi *</label> 
    <div class="col-md-9">
        <?php if ($arr_provinsi): ?>
            <select  class="form-control input-md required" id="slc_provinsi" name="id_provinsi"  aria-describedby="hlpBlock3">
                <?php foreach ($arr_provinsi as $id_provinsi => $nama_provinsi): ?>
                    <option value="<?php echo $id_provinsi; ?>"><?php echo $nama_provinsi; ?></option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
        <span id="hlpBlock3" class="help-block">
            <div id="dvAlertProvinsi" class="dvAlert"></div>
        </span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label" for="id_kab_kota"> Kabupaten / Kota *</label> 
    <div class="col-md-9">
        <select class="form-control required" name="id_kab_kota" id="slc_kab_kota" aria-describedby="hlpBlock4"></select>
        <span id="hlpBlock4" class="help-block">
            <div id="dvAlertKabupatenKota" class="dvAlert"></div>
        </span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label" for="id_kecamatan"> Kecamatan *</label> 
    <div class="col-md-9">
        <select class="form-control required" name="id_kecamatan" id="slc_id_kecamatan" aria-describedby="hlpBlock5"></select>
        <span id="hlpBlock5" class="help-block">
            <div id="dvAlertKecamatan" class="dvAlert"></div>
        </span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label" for="id_desa"> Desa *</label> 
    <div class="col-md-9">
        <select class="form-control required" name="id_desa" id="slc_desa" aria-describedby="hlpBlock6"></select>
        <span id="hlpBlock6" class="help-block">
            <div id="dvAlertDesa" class="dvAlert"></div>
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
<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href = '<?= base_url() ?>rencanaPembangunan/c_rancangan_rpjm_desa'" />
</p>

<?php echo form_close(); ?>


<script>
    function nav_active() {

        document.getElementById("a-data-perencanaan").className = "collapsed active";
        document.getElementById("perencanaan").className = "collapsed active";

        document.getElementById("a-data-rancangan_rpjm_desa").className = "collapsed active";

    }

    var ResetInputSelect = function (id) {

        $(id).find('option')
                .remove()
                .end();

    };

    var ValidateInput = function (elem, dvAlert, msg) {

        if ($("#" + elem + "").val() == '' || $("#" + elem + "").val() == null) {
            $("#" + elem + "").addClass('has-warning');

            $("#" + dvAlert + "").append(msg);
            return false;
        }
        return true;
    };

    var ResetValidationMessage = function () {
        $(".dvAlert").empty();
    };

// very simple to use!
    $(document).ready(function () {
        nav_active();

        $("#simpan").click(function () {
            ResetValidationMessage();

            var formvalid = ValidateInput("slc_tahun_anggaran_awal", "dvAlertTahunAnggaranAwal", "Tahun Anggaran Awal harus diisi");
            formvalid = formvalid && ValidateInput("slc_tahun_anggaran_akhir", "dvAlertTahunAnggaranAwal", "<br />Tahun Anggaran Akhir harus diisi");
            formvalid = formvalid && ValidateInput("slc_provinsi", "dvAlertProvinsi", "Provinsi harus diisi");
            formvalid = formvalid && ValidateInput("slc_kab_kota", "dvAlertKabupatenKota", "Kabupaten / Kota harus diisi");
            formvalid = formvalid && ValidateInput("slc_id_kecamatan", "dvAlertKecamatan", "Kecamatan harus diisi");
            formvalid = formvalid && ValidateInput("slc_desa", "dvAlertDesa", "Desa harus diisi");
            formvalid = formvalid && ValidateInput("kepala_desa", "dvAlertKepalaDesa", "Kepala Desa harus diisi");
            formvalid = formvalid && ValidateInput("disusun_oleh", "dvAlertDisusunOleh", "Disusun oleh harus diisi");
            formvalid = formvalid && ValidateInput("tanggal_disusun", "dvAlertTanggalDisusun", "Tanggal Disusun harus diisi");

            if (formvalid) {
                if (confirm("Mohon tetap di halaman ini ketika proses sedang berjalan.\nProses Akan berhenti ketika anda berpindah halaman.Hendaknya memeriksa kembali sebelum melakukan simpan data.\n\nAnda yakin akan melanjutkan ? ")) {
                    $(this).attr("disabled", true);
                    $(this).attr("value", "Tunggu .. ");

                    $("#batal").attr("disabled", true);

                    $("#frmTambahMasterRPJM").submit();
                }
            }
            return false;
        });

        $("#slc_tahun_anggaran_awal").change(function () {
            var self_val = $(this).val(), nextval = parseInt(self_val) - 8, topnextval = parseInt(self_val) + 6 + 8;


            ResetInputSelect($("#slc_tahun_anggaran_akhir"));
            ResetInputSelect($("#slc_tahun_anggaran_awal"));
//            console.log(nextval, topnextval);

            var optTahunAkhir = '';
            for (nextval; nextval <= topnextval; nextval++) {
                optTahunAkhir += '<option value=\'' + nextval + '\'>' + nextval + '</option>';
            }
            
            $("#slc_tahun_anggaran_akhir").append(optTahunAkhir);
            $("#slc_tahun_anggaran_akhir").val(parseInt(self_val)+5);
            $("#slc_tahun_anggaran_awal").append(optTahunAkhir);
            $("#slc_tahun_anggaran_awal").val(self_val);
        });


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

        $("#slc_kab_kota").change(function () {
            var val = $(this).val();

            ResetInputSelect($("#slc_id_kecamatan"));
            ResetInputSelect($("#slc_desa"));

            if (val != null) {
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/c_kec/get_json_array_by_kab_kota',
                    data: {
                        id_kab_kota: val
                    },
                    method: 'POST',
                    data_type: 'json',
                    success: function (response) {
                        if (response !== 'fail') {
                            var opt = '';
//                            console.log(response);
                            $.each(response, function (index, option) {
                                opt += '<option value=\'' + option.id_kecamatan + '\'>' + option.nama_kecamatan + '</option>';
                            });
                            $("#slc_id_kecamatan").append(opt);

                            $("#slc_id_kecamatan").change();
                        }
                    }
                });
            }
        });

        $("#slc_id_kecamatan").change(function () {
            var val = $(this).val();

            ResetInputSelect($("#slc_desa"));

            if (val != null) {
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/c_desa/get_json_array_by_kecamatan',
                    data: {
                        id_kecamatan: val
                    },
                    method: 'POST',
                    data_type: 'json',
                    success: function (response) {
                        if (response !== 'fail') {
                            var opt = '';
//                            console.log(response);
                            $.each(response, function (index, option) {
                                opt += '<option value=\'' + option.id_desa + '\'>' + option.nama_desa + '</option>';
                            });
                            $("#slc_desa").append(opt);
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