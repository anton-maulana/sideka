<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


$config['array_total_bidang'] = array(
    '2.1' => "total_bidang_1",
    '2.2' => "total_bidang_2",
    '2.3' => "total_bidang_3",
    '2.4' => "total_bidang_4",
);
/**
 * 
 * array('title', 'lebar kolom', ?, 'text alignment', ?)
 * array('Tahun Anggaran', 120, TRUE, 'center', 2);
 */
$config['rp_rancangan_rpjm_desa'] = array(
    'colModel' => array(
        'id_rancangan_rpjm_desa' => array('ID', 30, TRUE, 'center', 0),
        'bidang' => array('Bidang', 100, TRUE, 'center', 2),
        'sub_bidang' => array('Sub Bidang', 120, TRUE, 'center', 2),
        'jenis_kegiatan' => array('Jenis Kegiatan', 120, TRUE, 'center', 2),
        'lokasi_rt_rw' => array('Lokasi<br />(RT/RW<br />/Dusun)', 60, TRUE, 'center', 2),
        'prakiraan_volume' => array('Prakiraa<br />Volume', 60, TRUE, 'center', 2),
        'sasaran_manfaat' => array('Sasaran Manfaat', 120, TRUE, 'center', 2),
        'tahun_pelaksanaan_1' => array('Tahun<br />Pelaksanaan 1', 50, TRUE, 'center', 2),
        'tahun_pelaksanaan_2' => array('Tahun<br />Pelaksanaan 2', 50, TRUE, 'center', 2),
        'tahun_pelaksanaan_3' => array('Tahun<br />Pelaksanaan 3', 50, TRUE, 'center', 2),
        'tahun_pelaksanaan_4' => array('Tahun<br />Pelaksanaan 4', 50, TRUE, 'center', 2),
        'tahun_pelaksanaan_5' => array('Tahun<br />Pelaksanaan 5', 50, TRUE, 'center', 2),
        'tahun_pelaksanaan_6' => array('Tahun<br />Pelaksanaan 6', 50, TRUE, 'center', 2),
        'jumlah_biaya' => array('Prakiraan<br />Jumlah Biaya<br />(Rp)', 80, TRUE, 'right', 2),
        'sumber_dana' => array('Sumber<br />Pembiayaan', 100, TRUE, 'center', 2),
        'pelaksanaan_swakelola' => array('Swakelola', 100, TRUE, 'center', 2),
        'pelaksanaan_kerjasama_antar_desa' => array('Kerjasama<br />Antar Desa', 100, TRUE, 'center', 2),
        'pelaksanaan_kerjasama_pihak_ketiga' => array('Kerjasama<br />Pihak Ketiga', 100, TRUE, 'center', 2),
        'aksi' => array('Aksi', 120, FALSE, 'center', 0)
//        'aksi' => array('AKSI', 120, FALSE, 'center', 0)
    ),
    'buttons' => array(
//        array('Select All', 'check', 'btn'),
//        array('separator'),
        array('Tambah Detail', 'add', 'btn'),
    ),
    'gridParams' => array(
        'height' => 300,
        'width' => 'auto',
        'usepager' => FALSE,
//        'rp' => 10,
//        'rpOptions' => '[10,20,30,40]', /* jumlah opsi untuk mengganti jumlah halaman */
//        'pagestat' => 'Displaying: {from} to {to} of {total} items.',
//        'blockOpacity' => 0.5,
        'title' => 'Detail RPJM Desa ',
        'showTableToggleBtn' => FALSE
    )
);


$config['rp_master_rancangan_rpjm_desa'] = array(
    'colModel' => array(
        'id_m_rancangan_rpjm_desa' => array('ID', 30, TRUE, 'center', 0),
        'tahun_awal' => array('Tahun Awal', 100, TRUE, 'center', 2, 1),
        'tahun_akhir' => array('Tahun Akhir', 120, TRUE, 'center', 2, 1),
        'tahun_anggaran' => array('Tahun Anggaran', 120, TRUE, 'center', 2),
        'nama_file' => array('Nama File', 120, TRUE, 'center', 2, 1),
        'total_bidang_1' => array('Total Bidang 1', 60, TRUE, 'right', 2),
        'total_bidang_2' => array('Total Bidang 2', 60, TRUE, 'right', 2),
        'total_bidang_3' => array('Total Bidang 3', 120, TRUE, 'right', 2),
        'total_bidang_4' => array('Total Bidang 4', 50, TRUE, 'right', 2),
        'total_keseluruhan' => array('Total Jumlah', 80, TRUE, 'center', 2),
        'tanggal_disusun' => array('Tanggal Disusun', 100, TRUE, 'center', 2, 1),
        'disusun_oleh' => array('Disusun Oleh', 100, TRUE, 'center', 2, 1),
        'kepala_desa' => array('Nama<br />Kepala Desa', 100, TRUE, 'center', 2, 1),
        'id_desa' => array('id_desa', 100, TRUE, 'center', 0, 1),
        'nama_desa' => array('Desa', 100, TRUE, 'center', 2),
        'id_kecamatan' => array('id_kecamatan', 100, TRUE, 'center', 0, 1),
        'nama_kecamatan' => array('Kecamatan', 100, TRUE, 'center', 2, 1),
        'id_kab_bota' => array('id_kab_kota', 100, TRUE, 'center', 0, 1),
        'nama_kab_kota' => array('Kab/Kota', 100, TRUE, 'center', 2, 1),
        'id_provinsi' => array('id_provinsi', 100, TRUE, 'center', 0, 1),
        'nama_provinsi' => array('Provinsi', 100, TRUE, 'center', 2, 1),
        'aksi' => array('AKSI', 120, FALSE, 'center', 0)
    ),
    'buttons' => array(
//        array('Select All', 'check', 'btn'),
//        array('separator'),
        array('Tambah', 'add', 'btn'),
        array('separator'),
//        array('Import Excel', 'add', 'btn'),
//        array('separator'),
//        array('Delete Selected Items', 'delete', 'btn'),
//        array('separator')
    ),
    'gridParams' => array(
        'height' => 300,
        'width' => 855,
        'usepager' => TRUE,
        'rp' => 10,
        'rpOptions' => '[10,20,30,40]', /* jumlah opsi untuk mengganti jumlah halaman */
        'pagestat' => 'Displaying: {from} to {to} of {total} items.',
//        'blockOpacity' => 0.5,
        'title' => 'Rancangan RPJM Desa',
//        'showTableToggleBtn' => FALSE
    )
);
$config['content_rp_rancangan_rpjm_desa'] = array(
    'colModel' => array(
        'id_rancangan_rpjm_desa' => array('ID', 30, TRUE, 'center', 0),
        'bidang' => array('Bidang', 100, TRUE, 'center', 2),
        'sub_bidang' => array('Sub Bidang', 120, TRUE, 'center', 2),
        'jenis_kegiatan' => array('Jenis Kegiatan', 120, TRUE, 'center', 2),
        'lokasi_rt_rw' => array('Lokasi<br />(RT/RW<br />/Dusun)', 60, TRUE, 'center', 2),
        'prakiraan_volume' => array('Prakiraa<br />Volume', 60, TRUE, 'center', 2),
        'sasaran_manfaat' => array('Sasaran Manfaat', 120, TRUE, 'center', 2),
        'tahun_pelaksanaan_1' => array('Tahun<br />Pelaksanaan 1', 50, TRUE, 'center', 2),
        'tahun_pelaksanaan_2' => array('Tahun<br />Pelaksanaan 2', 50, TRUE, 'center', 2),
        'tahun_pelaksanaan_3' => array('Tahun<br />Pelaksanaan 3', 50, TRUE, 'center', 2),
        'tahun_pelaksanaan_4' => array('Tahun<br />Pelaksanaan 4', 50, TRUE, 'center', 2),
        'tahun_pelaksanaan_5' => array('Tahun<br />Pelaksanaan 5', 50, TRUE, 'center', 2),
        'tahun_pelaksanaan_6' => array('Tahun<br />Pelaksanaan 6', 50, TRUE, 'center', 2),
        'jumlah_biaya' => array('Prakiraan<br />Jumlah Biaya<br />(Rp)', 80, TRUE, 'right', 2),
        'sumber_dana' => array('Sumber<br />Pembiayaan', 100, TRUE, 'center', 2),
        'pelaksanaan_swakelola' => array('Swakelola', 100, TRUE, 'center', 2),
        'pelaksanaan_kerjasama_antar_desa' => array('Kerjasama<br />Antar Desa', 100, TRUE, 'center', 2),
        'pelaksanaan_kerjasama_pihak_ketiga' => array('Kerjasama<br />Pihak Ketiga', 100, TRUE, 'center', 2)
        //'aksi' => array('Aksi', 120, FALSE, 'center', 0)
//        'aksi' => array('AKSI', 120, FALSE, 'center', 0)
    ),
    'buttons' => array(
//        array('Select All', 'check', 'btn'),
//        array('separator'),
        array('Tambah Detail', 'add', 'btn'),
    ),
    'gridParams' => array(
        'height' => 300,
        'width' => 'auto',
        'usepager' => FALSE,
//        'rp' => 10,
//        'rpOptions' => '[10,20,30,40]', /* jumlah opsi untuk mengganti jumlah halaman */
//        'pagestat' => 'Displaying: {from} to {to} of {total} items.',
//        'blockOpacity' => 0.5,
        'title' => 'Detail RPJM Desa ',
        'showTableToggleBtn' => FALSE
    )
);

