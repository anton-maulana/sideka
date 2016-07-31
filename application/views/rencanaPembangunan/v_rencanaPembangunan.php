<?php
$logo_desa = $konten_logo->konten_logo_desa;

function rupiah($data) {
    $rupiah = "";
    $jml = strlen($data);
    while ($jml > 3) {
        $rupiah = "." . substr($data, -3) . $rupiah;
        $l = strlen($data) - 3;
        $data = substr($data, 0, $l);
        $jml = strlen($data);
    }
    $rupiah = $data . $rupiah;
    return $rupiah;
}
?>

<div class="row">
    <div class="col-md-6">
        <h3>Selamat Datang<br><b>Perencana Pembangunan Desa</b></h3>
        <legend></legend>
    </div>
    <div class="col-md-6" >
<<<<<<< HEAD
        <img src="<?php echo site_url($logo_desa); ?>" style="float:right; height:fixed; width:250px; margin-top:20px; margin-bottom:-40px;"> 		
=======
        <img src="<?php echo site_url($logo_desa); ?>" style="float:right; height:fixed; width:250px; margin-top:20px; margin-bottom:-40px;">
>>>>>>> f116a20c8be190662fb8a357c43f3c153e02482b
    </div>
    <div class="col-md-12">
        <!--
        <a href="<?php echo site_url(''); ?>">
                <button type="button" class="btn btn-success"><i class="fa fa-plus-square fa-fw"></i> +</button>
        </a>
        <a href="<?php echo site_url(''); ?>">
                <button type="button" class="btn btn-success"><i class="fa fa-list fa-fw"></i> =</button>
        </a>
        -->
    </div>
</div>
<br>
<<<<<<< HEAD
<div class="row">
    <div class="col-md-6">
        <div class="table-responsive">
            <table border="0" class="table table-striped table-bordered table-hover">
                <h4></b>Data Rencana Pembangunan Jangka Menengah Desa</b> 
                    <a href="<?php echo site_url('rencanaPembangunan/c_rancangan_rpjm_desa'); ?>">
                        <button type="button" class="btn btn-success btn-xs"><i class="fa fa-newspaper-o fa-fw"></i></button>
                    </a>
                </h4>

                <tr class="success">
                    <td style="text-align:center;">No</td>
                    <td style="text-align:center;">Periode</td>
                    <td style="text-align:center;">Kode Bidang</td>
                    <td style="text-align:center;">Program RPJMDes</td>

                </tr>
                <?php
                $i = 0;
                foreach ($rpjmdes as $rows) {
                    $i++;
                    $periode = $rows->periode;
                    $kode_bidang = $rows->kode_bidang;
                    $program_rpjmdes = $rows->program_rpjmdes;
                    ?>
                    <tr>

                        <td style="text-align:center;"><?php echo $i; ?></td>
                        <td style="text-align:left;"><?php echo $periode; ?></td>
                        <td style="text-align:center;"><?php echo $kode_bidang; ?></td>
                        <td style="text-align:left;"><?php echo $program_rpjmdes; ?></td>	
                    </tr>
    <?php
}
?>
            </table>
        </div>
    </div>	

    <div class="col-md-6">
        <div class="table-responsive">

            <table border="0" class="table table-bordered table-hover">
                <h4></b>Data Rencana Kerja Pemerintah Desa</b>
                    <a href="<?php echo site_url('rencanaPembangunan/c_rkp'); ?>">
                        <button type="button" class="btn btn-success btn-xs"><i class="fa fa-newspaper-o fa-fw"></i></button>
                    </a>
                </h4>
                <tr class="success">
                    <td style="text-align:center;">No</td>
                    <td style="text-align:center;">Kode Bidang</td>
                    <td style="text-align:center;">Kode Rekening</td>
                    <td style="text-align:center;">Program RPKDes</td>

                </tr>
<?php
$i = 0;
foreach ($rkpdes as $rows) {
    $i++;
    $kode_bidang = $rows->kode_bidang;
    $kode_rekening = $rows->kode_rekening;
    $program_rkpdes = $rows->program_rkpdes;
    ?>
                    <tr>

                        <td style="text-align:center;"><?php echo $i; ?></td>
                        <td style="text-align:center;"><?php echo $kode_bidang; ?></td>
                        <td style="text-align:center;"><?php echo $kode_rekening; ?></td>
                        <td style="text-align:left;"><?php echo $program_rkpdes; ?></td>	
                    </tr>
    <?php
}
?>
            </table>
        </div>
    </div>

    <div class="col-md-6">
        <div class="table-responsive">
            <table border="0" class="table table-bordered table-hover">
                <h4></b>Data Rencana Anggaran Biaya Desa</b>
                    <a href="<?php echo site_url('rencanaPembangunan/c_apbdes'); ?>">
                        <button type="button" class="btn btn-info btn-xs"><i class="fa fa-newspaper-o fa-fw"></i></button>
                    </a>
                </h4>
                <tr class="info">
                    <td style="text-align:center;">No</td>
                    <td style="text-align:center;">Tahun</td>
                    <td style="text-align:center;">Kegiatan</td>
                    <td style="text-align:center;">Total (Rp)</td>

                </tr>
<?php
$i = 0;
foreach ($rabdes as $rows) {
    $i++;
    $tahun_anggaran = $rows->tahun_anggaran;
    $kegiatan = $rows->kegiatan;
    $total = rupiah($rows->total) . ',-';
    ?>
                    <tr>

                        <td style="text-align:center;"><?php echo $i; ?></td>
                        <td style="text-align:left;"><?php echo $tahun_anggaran; ?></td>
                        <td style="text-align:left;"><?php echo $kegiatan; ?></td>
                        <td style="text-align:right;"><?php echo $total; ?></td>	
                    </tr>
    <?php
}
?>
            </table>
        </div>
    </div>

    <div class="col-md-6">
        <div class="table-responsive">
            <table border="0" class="table table-bordered table-hover">
                <h4></b>Daftar Data Pustaka Perencanaan</b>
                    <a href="<?php echo site_url('rencanaPembangunan/c_periode'); ?>">
                        <button type="button" class="btn btn-info btn-xs"><i class="fa fa-newspaper-o fa-fw"></i></button>
                    </a>
                </h4>
                <tr class="info">
                    <td style="text-align:center;">Periode</td>
                    <td style="text-align:center;">Tahun Anggaran</td>
                    <td style="text-align:center;">Bidang</td>
                    <td style="text-align:center;">Kode Rekening</td>
					<td style="text-align:center;">Sumber Dana</td>
                </tr>
<?php
$i = 0;
foreach ($spp as $rows) {
    $i++;
    $kegiatan = $rows->kegiatan;
    $total = rupiah($rows->total) . ',-';
    $tgl_ambil = $rows->tgl_ambil;
    ?>
                    <tr>

                        <td style="text-align:center;"><?php echo $i; ?></td>
                        <td style="text-align:left;"><?php echo $kegiatan; ?></td>
                        <td style="text-align:right;"><?php echo $total; ?></td>
                        <td style="text-align:center;"><?php echo $tgl_ambil; ?></td>	
                    </tr>
    <?php
}
?>
            </table>
        </div>
    </div>
    <!--
    <div class="col-md-6" id="keluarga" style="margin: 0 auto;"></div>
    <div class="col-md-6" id="penduduk" style="margin: 0 auto;"></div>
    -->	


</div>
=======
>>>>>>> f116a20c8be190662fb8a357c43f3c153e02482b
<!-- /.row -->


<script type="text/javascript">
    $(function () {

        // Radialize the colors
        Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
            return {
                radialGradient: {cx: 0.5, cy: 0.3, r: 0.7},
                stops: [
                    [0, color],
                    [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                ]
            };
        });

        $('#keluarga').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafik Statistik Desa'
            },
            subtitle: {
                text: 'Berdasarkan Jenis Kelamin Kepala Keluarga'
            },
            xAxis: {
                categories: [
                    'Kepala Keluarga'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Kepala Keluarga'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y} KK</b></td></tr>',
                footerFormat: '</table>',
                shared: false,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                    name: 'Laki Laki',
                    data: [
<?php echo $jumlah_kk_laki; ?>
                    ]

                }, {
                    name: 'Perempuan',
                    data: [
<?php echo $jumlah_kk_perempuan; ?>
                    ]

                }]

        });

        $('#penduduk').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Grafik Statistik Desa'
            },
            subtitle: {
                text: 'Berdasarkan Jenis Kelamin Pendudukan'
            },
            tooltip: {
                //pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                headerFormat: '<span style="font-size:10px">{point.key}: {point.percentage:.1f}%</span><table><br>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y} Jiwa</b></td></tr>',
                footerFormat: '</table>',
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        },
                        connectorColor: ''
                    }
                }
            },
            series: [{
                    type: 'pie',
                    name: 'sebanyak',
                    data: [
                        ['L ',<?php echo $jumlah_penduduk_laki; ?>],
                        ['P ',<?php echo $jumlah_penduduk_perempuan; ?>]

                    ]

                }]
        });
    });


</script>



</script>


<script>
    function nav_active() {
        document.getElementById("a-pengelola_perencanaan").className = "collapsed active";
    }
// very simple to use!
    $(document).ready(function () {
        nav_active();
    });
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assetku/highchart/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/highchart/highcharts-3d.js"></script>
<<<<<<< HEAD
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/highchart/exporting.js"></script>
=======
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/highchart/exporting.js"></script>
>>>>>>> f116a20c8be190662fb8a357c43f3c153e02482b
