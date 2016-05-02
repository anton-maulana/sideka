<?php
/**
 * Index RKP
 */
$attention_message = isset($attention_message) && $attention_message ? $attention_message : FALSE;
$controller_name = isset($controller_name) ? $controller_name : 'c_rkp';
$id_m_rkp = isset($id_m_rkp) ? $id_m_rkp : '';
?>
<link href="<?php echo $this->config->item('base_url'); ?>css/flexigrid.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?= $this->config->item('base_url'); ?>js/jquery.pack.js"></script>
<script type="text/javascript" src="<?= $this->config->item('base_url'); ?>js/flexigrid.pack.js"></script>


<h3><?php echo $page_title; ?></h3>
<h5><b><?php echo $deskripsi_title; ?></b></h5>
<legend></legend>

<?php
echo $attention_message ? '<p class="message">' . $attention_message . '</p>' : '';
?>

<?php
echo $js_grid;
?>

<form id="frmAddDetail" style="visibility: hidden;" method="POST" action="<?php echo site_url("rencanaPembangunan/c_rancangan_rpjm_desa/add_detail/"); ?>">
    <input type="hidden" id="mId" name="mId" value="" />
</form>
<script type="text/javascript">
    var _base_url = '<?= base_url() ?>';


    function show_detail_program(id) {
        window.location = _base_url + 'rencanaPembangunan/<?php echo $controller_name; ?>/detail/' + id;
    }

    function download_excel(id) {
        window.location = _base_url + 'rencanaPembangunan/<?php echo $controller_name; ?>/download_excel/' + id;
    }

    function btn(com, grid)
    {
        if (com == 'Select All')
        {
            $('.bDiv tbody tr', grid).addClass('trSelected');
        }

        if (com == 'DeSelect All')
        {
            $('.bDiv tbody tr', grid).removeClass('trSelected');
        }

        if (com == 'Import Excel')
        {
            window.location = _base_url + 'rencanaPembangunan/<?php echo $controller_name; ?>/import_excel';
        }

        if (com == 'Tambah Detail')
        {
            window.location = _base_url + 'rencanaPembangunan/<?php echo $controller_name; ?>/add_detail/<?php echo $id_m_rkp; ?>';
        }

//        if (com == 'Delete Selected Items')
//        {
//            if ($('.trSelected', grid).length > 0) {
//                if (confirm('Hapus ' + $('.trSelected', grid).length + ' item?')) {
//                    var items = $('.trSelected', grid);
//                    var itemlist = '';
//                    for (i = 0; i < items.length; i++) {
//                        itemlist += items[i].id.substr(3) + ",";
//                    }
//                    $.ajax({
//                        type: "POST",
//                        url: "<?= site_url("rencanaPembangunan/<?php echo $controller_name; ?>/delete/"); ?>",
//                        data: "items=" + itemlist,
//                        success: function (data) {
//                            $('#flex1').flexReload();
//                            alertify.success("Data berhasil dihapus !");
//                        },
//                        error: function () {
//                            alertify.error("Maaf, data yang akan dihapus masih digunakan !");
//                        }
//                    });
//                }
//            } else {
//                return false;
//            }
//        }
    }

    function add_detail(self) {
        var sId = self.id.split('_'), mId = sId[2];

        window.location = _base_url + 'rencanaPembangunan/<?php echo $controller_name; ?>/add_detail/' + mId;
    }

    $(function () {

    });
</script>

<table id="flex1" style="display:none"></table>

<span class="help-block">

    <a href="<?php echo base_url().'rencanaPembangunan/c_rkp'; ?>" class="btn btn-danger">Kembali</a>

</span>

<script type="text/javascript">
    function nav_active() {

        document.getElementById("a-data-perencanaan").className = "collapsed active";
        document.getElementById("perencanaan").className = "collapsed active";

        document.getElementById("a-data-rkp_desa").className = "collapsed active";

    }

// very simple to use!
    $(document).ready(function () {
        nav_active();
    });
</script>