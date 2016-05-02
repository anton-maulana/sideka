<?php
$attention_message = isset($attention_message) && $attention_message ? $attention_message : FALSE;
$controller_name = isset($controller_name) ? $controller_name : 'c_rkp';
$arr_provinsi = isset($arr_provinsi) ? $arr_provinsi : FALSE;
$post_data = isset($post_data) && !empty($post_data) && $post_data ? $post_data : FALSE;

$master_rpjm = isset($master_rpjm) ? $master_rpjm : FALSE;
$bidang = isset($bidang) ? $bidang : FALSE;

$id_m_rkp = isset($id_m_rkp) ? $id_m_rkp : '';
$form_url = 'rencanaPembangunan/' . $controller_name . '/add_detail/' . $id_m_rkp . (!empty($post_data) && $post_data ? '/' . $post_data["id_rkp"] : '');
?>

<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>

<?php
echo $attention_message ? '<p class="message">' . $attention_message . '</p>' : '';
?>

<?php echo form_open_multipart($form_url, array('id' => 'frmTambahDetailRKP')); ?>
<legend></legend>


<div class="form-group">
    <label class="col-md-5 control-label" for="id_bidang"> Bidang *</label> 
    <div class="col-md-9">
        <select  class="form-control required" id="slc_bidang" name="id_bidang" aria-describedby="hlpBlock1">
            <option value="">-- Pilih Bidang --</option>
            <?php if ($bidang): ?>
                <?php foreach ($bidang as $key => $deskripsi): ?>
                    <option value="<?php echo $key; ?>" <?php echo $post_data && $key == $post_data["id_bidang"] ? "selected=\"selected\"" : ""; ?>><?php echo ucwords(strtolower($deskripsi)); ?></option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value=""></option>
            <?php endif; ?>
        </select>
        <span id="hlpBlock1" class="help-block">
            <div id="dvAlertslc_bidang" class="dvAlert"></div>
        </span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-5 control-label" for="jenis_kegiatan"> Jenis Kegiatan *</label> 
    <div class="col-md-9">
        <input type="hidden" id="inp_jenis_kegiatan" name="jenis_kegiatan" value="" />
        <select  class="form-control input-md required" id="slc_id_rancangan_rpjm_desa" name="id_rancangan_rpjm_desa"  aria-describedby="hlpBlock3">
            <option value="">-- Pilih Bidang Terlebih Dahulu --</option>
        </select>
        <span id="hlpBlock3" class="help-block">
            <div id="dvAlertslc_id_rancangan_rpjm_desa" class="dvAlert"></div>
        </span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-5 control-label" for="lokasi"> Lokasi</label> 
    <div class="col-md-9">
        <input class="form-control input-md required" type="text" name="lokasi" id="inp_lokasi" size="80" value="<?php echo $post_data ? $post_data["lokasi"] : ''; ?>" aria-describedby="hlpBlock8" /> 
        <span id="hlpBlock8" class="help-block">
            <div id="dvAlertinp_lokasi" class="dvAlert"></div>
        </span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-5 control-label" for="tanggal_disusun"> Volume</label> 
    <div class="col-md-9">
        <input class="form-control input-md required" type="text" name="volume" id="inp_volume" size="80" value="<?php echo $post_data ? $post_data["volume"] : ''; ?>" aria-describedby="hlpBlock9" /> 
        <span id="hlpBlock9" class="help-block">
            <div id="dvAlertinp_volume" class="dvAlert"></div>
        </span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-5 control-label" for="tanggal_disusun"> Sasaran manfaat</label> 
    <div class="col-md-9">
        <input class="form-control input-md required" type="text" name="sasaran_manfaat" id="inp_sasaran_manfaat" size="80" value="<?php echo $post_data ? $post_data["sasaran_manfaat"] : ''; ?>" aria-describedby="hlpBlock9" /> 
        <span id="hlpBlock9" class="help-block">
            <div id="dvAlertinp_sasaran_manfaat" class="dvAlert"></div>
        </span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-5 control-label" for="tanggal_disusun"> Waktu Pelaksanaan *</label> 
    <div class="col-md-9">
        <input class="form-control input-md required" type="text" name="waktu_pelaksanaan" id="inp_waktu_pelaksanaan" size="80" value="<?php echo $post_data ? $post_data["waktu_pelaksanaan"] : ''; ?>" aria-describedby="hlpBlock9" /> 
        <span id="hlpBlock9" class="help-block">
            <div id="dvAlertinp_waktu_pelaksanaan" class="dvAlert"></div>
        </span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-5 control-label" for="tanggal_disusun"> Prakiraan biaya *</label> 
    <div class="col-md-9">
        <input class="form-control input-md required" type="text" name="jumlah_biaya" id="inp_jumlah_biaya" size="80" value="<?php echo $post_data ? $post_data["jumlah_biaya"] : ''; ?>" aria-describedby="hlpBlock9" /> 

        <span id="hlpBlock9" class="help-block">
            <div id="dvAlertinp_jumlah_biaya" class="dvAlert"></div>
        </span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-5 control-label" for="tanggal_disusun"> Rencana Pelaksanaan Kegiatan</label> 
    <div class="col-md-9">
        <input class="form-control input-md required" type="text" name="rencana_pelaksanaan_kegiatan" id="inp_rencana_pelaksanaan_kegiatan" size="80" value="<?php echo $post_data ? $post_data["rencana_pelaksanaan_kegiatan"] : ''; ?>" aria-describedby="hlpBlock9" /> 

        <span id="hlpBlock9" class="help-block">
            <div id="dvAlertinp_rencana_pelaksanaan_kegiatan" class="dvAlert"></div>
        </span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-5 control-label" for="kepala_desa"> Pola Pelaksanaan *</label>
    <div class="col-md-9">

        <input type="checkbox" value="1" name="swakelola" id="swakelola" autocomplete="off"> Swakelola
        <br />
        <input type="checkbox" value="1" name="kerjasama_antar_desa" id="kerjasama_antar_desa" autocomplete="off"> Kerjasama Antar Desa
        <br />
        <input type="checkbox" value="1" name="kerjasama_pihak_ketiga" id="kerjasama_pihak_ketiga" autocomplete="off"> Kerjasama Pihak Ketiga

    </div>
    <span class="help-block">
        <div class="dvAlertPolaPelaksanaan"></div>
    </span>
</div>

<p>
<legend></legend>
<input type="submit" value="Simpan" class="btn btn-success" id="simpan"/>
<?php /* <input type="submit" value="Simpan dan Tambah" class="btn btn-success" id="simpan_tambah_kembali"/> */ ?>
<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href = '<?php echo base_url(); ?>rencanaPembangunan/c_rkp'" />
</p>

<?php echo form_close(); ?>

<?php
echo isset($js_general_helper) ? $js_general_helper : '';
echo isset($js_rkp_add_detail) ? $js_rkp_add_detail : '';
?>


<script>
    function nav_active() {

        document.getElementById("a-data-perencanaan").className = "collapsed active";
        document.getElementById("perencanaan").className = "collapsed active";

        document.getElementById("a-data-rkp_desa").className = "collapsed active";
    }

// very simple to use!
    $(document).ready(function () {
        nav_active();

        $("#simpan").click(function () {
            ResetValidationMessage();

            var formvalid = ValidateInput("slc_bidang", "dvAlertslc_bidang", "Bidang Harus diisi");
            formvalid = formvalid && ValidateInput("slc_id_rancangan_rpjm_desa", "dvAlertslc_id_rancangan_rpjm_desa", "Jenis Kegiatan harus diisi");
            formvalid = formvalid && ValidateInput("inp_lokasi", "dvAlertinp_lokasi", "Lokasi harus diisi");
            formvalid = formvalid && ValidateInput("inp_volume", "dvAlertinp_volume", "Volume harus diisi");
            formvalid = formvalid && ValidateInput("inp_waktu_pelaksanaan", "dvAlertdvAlertinp_waktu_pelaksanaan", "Waktu Pelaksanaan harus diisi");
            formvalid = formvalid && ValidateInput("inp_jumlah_biaya", "dvAlertinp_jumlah_biaya", "Jumlah Biaya harus diisi");

            var optMetodePelaksanaanOk = $("#swakelola").attr("checked") || $("#kerjasama_antar_desa").attr("checked") || $("#kerjasama_pihak_ketiga").attr("checked");


            console.log(optMetodePelaksanaanOk);
            if (!optMetodePelaksanaanOk) {
                $("#dvAlertPolaPelaksanaan").append("Salah satu harus dipilih");
            }


            if (formvalid) {
                if (confirm("Mohon tetap di halaman ini ketika proses sedang berjalan.\nProses Akan berhenti ketika anda berpindah halaman.Hendaknya memeriksa kembali sebelum melakukan simpan data.\n\nAnda yakin akan melanjutkan ? ")) {
                    $(this).attr("disabled", true);
                    $(this).attr("value", "Tunggu .. ");

                    $("#batal").attr("disabled", true);

                    $("#frmTambahDetailRKP").submit();
                }
            }
            return false;
        });

        $("#slc_bidang").change(function () {
            if (!$.isEmptyObject(rpjm)) {

                var val = $(this).val(), arr_rpjm = val in rpjm ? rpjm[val] : null;

                ResetInputSelect($("#slc_id_rancangan_rpjm_desa"));

                if (arr_rpjm != null) {
                    var opt = '';
                    $.each(arr_rpjm, function (index, options) {
                        if (options.length > 0) {
                            $.each(options, function (index, option) {
                                opt += '<option value=\'' + option.id_rancangan_rpjm_desa + '\'>' + option.jenis_kegiatan + '; ' + option.lokasi_rt_rw + '; ' + option.prakiraan_volume + '</option>';
                            });
                        }
                    });

                    $("#slc_id_rancangan_rpjm_desa").append(opt);

                    $("#slc_id_rancangan_rpjm_desa").change();
                }
            }
            /**
             * @todo warning bahwa rpjm belum ada detail
             */
        });

        $("#slc_id_rancangan_rpjm_desa").change(function () {
            if (!$.isEmptyObject(rpjm)) {
                var valBidang = $("#slc_bidang").val(), arr_rpjm = valBidang in rpjm ? rpjm[valBidang] : null, idRancanganRpjmDesa = $(this).val(), jumlahBiayaTersedia = 0;

                if (arr_rpjm != null) {
                    $.each(arr_rpjm, function (index, objs) {
                        if (objs.length > 0) {
                            $.each(objs, function (index, obj) {
                                if (obj.id_rancangan_rpjm_desa == idRancanganRpjmDesa) {
                                    $("#inp_jenis_kegiatan").val(obj.jenis_kegiatan);
                                    $("#inp_lokasi").val(obj.lokasi_rt_rw);
                                    $("#inp_volume").val(obj.prakiraan_volume);
                                    $("#inp_sasaran_manfaat").val(obj.sasaran_manfaat);
                                    jumlahBiayaTersedia = obj.jumlah_biaya;
//                            $("#inp_jumlah_biaya").val(toRp(obj.jumlah_biaya));
                                }
                            });
                        }
                    });

                    $.ajax({
                        url: '<?php echo base_url(); ?>rencanaPembangunan/c_rkp/get_cost',
                        data: {
                            id_bidang: valBidang,
                            id_rancangan_rpjm_desa: $("#slc_id_rancangan_rpjm_desa").val(),
                        },
                        method: 'POST',
                        data_type: 'json',
                        success: function (response) {

                            if (response !== '0') {
                                $("#inp_jumlah_biaya").val(toRp(parseInt(jumlahBiayaTersedia) - parseInt(response)));
                                $("#inp_ref_num_jumlah_biaya").val(parseInt(jumlahBiayaTersedia) - parseInt(response));
                            } else {
                                $("#inp_jumlah_biaya").val(toRp(parseInt(jumlahBiayaTersedia)));
                                $("#inp_ref_num_jumlah_biaya").val(parseInt(jumlahBiayaTersedia));
                            }
                        }
                    });

                }
            }
        });


<?php if (!empty($post_data) && $post_data): ?>

$("#slc_bidang").change();

$("#slc_id_rancangan_rpjm_desa").val(<?php echo $post_data["id_rancangan_rpjm_desa"]; ?>);

$("#slc_id_rancangan_rpjm_desa").change();

    <?php
    foreach (array(
"swakelola",
 "kerjasama_antar_desa",
 "kerjasama_pihak_ketiga",
    ) as $inp_check) {
        if (!is_null($post_data[$inp_check]) && $post_data[$inp_check] != FALSE):
            echo "setCheck('" . $inp_check . "');";
        else:
            echo "remCheck('" . $inp_check . "');";
        endif;
    }
    ?>

<?php endif; ?>
    });
</script>