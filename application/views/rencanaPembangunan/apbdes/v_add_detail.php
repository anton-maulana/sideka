<?php
$attention_message = isset($attention_message) && $attention_message ? $attention_message : FALSE;
$controller_name = isset($controller_name) ? $controller_name : 'c_rkp';
$arr_provinsi = isset($arr_provinsi) ? $arr_provinsi : FALSE;
$post_data = isset($post_data) && !empty($post_data) && $post_data ? $post_data : FALSE;


$master_rkp = isset($master_rkp) ? $master_rkp : FALSE;
$master_rpjm = isset($master_rpjm) ? $master_rpjm : FALSE;
$top_level_coa = isset($top_level_coa) ? $top_level_coa : FALSE;


$id_m_apbdes = isset($id_m_apbdes) ? $id_m_apbdes : '';
$id_apbdes = isset($id_apbdes) ? $id_apbdes : FALSE;
$form_url = 'rencanaPembangunan/' . $controller_name . '/add_detail/' . $id_m_apbdes . ($id_apbdes ? '/' . $id_apbdes : '');
?>
<link href="<?php echo base_url(); ?>assetku/js/plugins/select2/css/select2.min.css" rel="stylesheet">
<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>

<?php
echo $attention_message ? '<p class="message">' . $attention_message . '</p>' : '';
?>

<?php echo form_open_multipart($form_url, array('id' => 'frmTambahAPBDES')); ?>
<legend></legend>

<div class="form-group">
    <label class="col-md-3 control-label" for="group_coa"> Grup COA *</label> 
    <div class="col-md-9">

        <select  class="form-control input-md required" id="slc_group_coa" name="id_top_coa"  aria-describedby="hlpBlock3">
            <?php if ($top_level_coa): ?>
                <?php foreach ($top_level_coa as $key => $record_top_level_coa): ?>
                    <option value="<?php echo $record_top_level_coa->id_coa; ?>" <?php echo $post_data && $post_data["id_top_coa"] == $record_top_level_coa->id_coa ? "selected=\"selected\"" : ""; ?>><?php echo $record_top_level_coa->deskripsi; ?></option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="">-- Tidak ada COA ditemukan --</option>
            <?php endif; ?>

        </select>

        <span id="hlpBlock3" class="help-block">
            <div id="dvAlertslc_group_coa" class="dvAlert">
            </div>
        </span>
    </div>
</div>
<legend></legend>


<div class="form-group">
    <label class="col-md-3 control-label" for="id_coa"> Kode Rekening *</label> 
    <div class="col-md-9">

        <select  class="form-control input-md required" id="slc_id_coa" name="id_coa"  aria-describedby="hlpBlock3">
        </select>
        <span id="hlpBlock3" class="help-block">
            <div id="dvAlertslc_id_coa" class="dvAlert">
            </div>
        </span>
    </div>
</div>
<legend></legend>


<div class="form-group">
    <label class="col-md-3 control-label" for="anggaran"> Anggaran (Rp) *</label> 
    <div class="col-md-9">
        <input class="form-control input-md required" type="text" name="anggaran" id="inp_anggaran" size="80" value="<?php echo $post_data ? $post_data["anggaran"] : ''; ?>"  aria-describedby="hlpBlock7" /> 
        <span id="hlpBlock7" class="help-block">
            <div id="dvAlertanggaran" class="dvAlert"></div>
        </span>
    </div>
</div>
<legend></legend>
<div class="form-group">
    <label class="col-md-3 control-label" for="keterangan"> Keterangan</label> 
    <div class="col-md-9">
        <textarea class="form-control input-md" name="keterangan" id="keterangan"><?php echo $post_data ? $post_data["keterangan"] : ''; ?></textarea>
        <span id="hlpBlock8" class="help-block">
            <div id="dvAlertketerangan" class="dvAlert"></div>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/plugins/select2/js/select2.full.min.js"></script>
<script>
    function nav_active() {

        document.getElementById("a-data-perencanaan").className = "collapsed active";
        document.getElementById("perencanaan").className = "collapsed active";

        document.getElementById("a-data-apb_desa").className = "collapsed active";
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

            var validasi_a = ValidateInput("slc_group_coa", "dvAlertslc_group_coa", "Grup COA harus diisi"),
                    validasi_b = ValidateInput("slc_id_coa", "dvAlertslc_id_coa", "Kode Rekening harus diisi"),
                    validasi_c = ValidateInput("inp_anggaran", "dvAlertanggaran", "Anggaran harus diisi"),
                    formvalid = validasi_a && validasi_b && validasi_c;

            if (formvalid) {
                if (confirm("Mohon tetap di halaman ini ketika proses sedang berjalan.\nProses Akan berhenti ketika anda berpindah halaman.Hendaknya memeriksa kembali sebelum melakukan simpan data.\n\nAnda yakin akan melanjutkan ? ")) {
                    $(this).attr("disabled", true);
                    $(this).attr("value", "Tunggu .. ");

                    $("#batal").attr("disabled", true);

                    $("#frmTambahAPBDES").submit();
                }
            }
            return false;
        });

        $("#slc_id_coa").select2({
            minimumInputLength: 2,
            language: "id",
            ajax: {
                url: '<?php echo base_url() . 'rencanaPembangunan/c_baseRencanaPembangunan/select_coa'; ?>',
                dataType: 'json',
                type: "POST",
                quietMillis: 50,
                data: function (term) {
                    return {
                        keyword: term,
                        id_top_coa: $("#slc_group_coa").val(),
                        inp: 'select2'
                    };
                },
                results: function (data) {
                    return {results: data};
                }
            },
            formatResult: function (data, term) {
                return data;
            },
            formatSelection: function (data) {
                return data;
            }
        });

<?php if ($post_data): ?>
            
            var $option = $('<option selected>Baca Data...</option>').val("");
            
            $("#slc_id_coa").append($option).trigger('change');

            $.ajax({// make the request for the selected data object
                type: 'POST',
                url: '<?php echo base_url() . 'rencanaPembangunan/c_baseRencanaPembangunan/select_coa'; ?>',
                dataType: 'json',
                data: {
                    keyword: '<?php echo $post_data["kode_rekening"]; ?>',
                    id_top_coa: $("#slc_group_coa").val(),
                    inp: 'select2',
                    initEdit: <?php echo $post_data["id_coa"]; ?>,
                }
            }).then(function (data) {
                
                if(typeof data.results !== 'undefined' && data.results.length > 0){
                    $option.text(data.results[0].text).val(data.results[0].id);
                    $option.removeData();
                    $("#slc_id_coa").trigger('change');
                }
            });

<?php endif; ?>

    
    });
</script>