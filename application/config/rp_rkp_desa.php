<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/**
 * 
 * array('title', 'lebar kolom', ?, 'text alignment', ?)
 * array('Tahun Anggaran', 120, TRUE, 'center', 2);
 */

$config['rp_rkp_desa'] = array(
    'colModel' => array(
        'id_m_rkp' => array('ID', 30, TRUE, 'center', 0),
        'id_m_rancangan_rpjm_desa' => array('ID RPJM', 30, TRUE, 'center', 0, 1),
        'rkp_tahun' => array('Tahun Anggaran', 100, TRUE, 'center', 2, 1),
        'bidang' => array('Bidang', 120, TRUE, 'center', 2),
        'jenis_kegiatan' => array('Jenis Kegiatan', 120, TRUE, 'center', 2),
        'lokasi' => array('Lokasi', 60, TRUE, 'center', 2),
        'volume' => array('Volume', 60, TRUE, 'center', 2),
        'sasaran_manfaat' => array('Sasaran Manfaat', 120, TRUE, 'center', 2),
        'waktu_pelaksanaan' => array('Waktu Pelaksanaan', 50, TRUE, 'center', 2),
        'jumlah_biaya' => array('Jumlah Biaya', 80, TRUE, 'right', 2),
        'pelaksanaan_swakelola' => array('Swakelola', 100, TRUE, 'center', 2),
        'pelaksanaan_kerjasama_antar_desa' => array('Kerjasama<br />Antar Desa', 100, TRUE, 'center', 2),
        'pelaksanaan_kerjasama_pihak_ketiga' => array('Kerjasama<br />Pihak Ketiga', 100, TRUE, 'center', 2),
        'rencana_pelaksanaan_kegiatan' => array('Rencana<br />Pelakasanaan<br />Kegiatan', 100, TRUE, 'center', 2),
        'aksi' => array('Aksi', 120, FALSE, 'center', 0)
    ),
    'buttons' => array(
//        array('Select All', 'check', 'btn'),
//        array('separator'),
        array('Tambah Detail', 'add', 'btn'),
        array('separator'),
//        array('separator'),
//        array('Delete Selected Items', 'delete', 'btn'),
//        array('separator')
    ),
    'gridParams' => array(
        'height' => 300,
        'width' => 'auto',
        'usepager' => FALSE,
//        'rp' => 10,
//        'rpOptions' => '[10,20,30,40]', /* jumlah opsi untuk mengganti jumlah halaman */
//        'pagestat' => 'Displaying: {from} to {to} of {total} items.',
//        'blockOpacity' => 0.5,
        'title' => 'Detail RKP Desa',
        'showTableToggleBtn' => FALSE
    )
);
$config['rp_master_rkp_desa'] = array(
    'colModel' => array(
        'id_m_rkp' => array('ID', 30, TRUE, 'center', 0),
        'id_m_rancangan_rpjm_desa' => array('ID RPJM', 30, TRUE, 'center', 0, 1),
        'tahun_awal' => array('Tahun Awal', 100, TRUE, 'center', 2, 1),
        'tahun_akhir' => array('Tahun Akhir', 120, TRUE, 'center', 2, 1),
        'tahun_anggaran' => array('Tahun Anggaran', 120, TRUE, 'center', 2),
        'total_bidang_1' => array('Total Bidang 1', 60, TRUE, 'right', 2),
        'total_bidang_2' => array('Total Bidang 2', 60, TRUE, 'right', 2),
        'total_bidang_3' => array('Total Bidang 3', 120, TRUE, 'right', 2),
        'total_bidang_4' => array('Total Bidang 4', 50, TRUE, 'right', 2),
        'total_keseluruhan' => array('Total Jumlah', 80, TRUE, 'right', 2),
        'rkp_tahun' => array('RKP Tahun', 120, TRUE, 'center', 2),
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
        'title' => 'RKP Desa',
//        'showTableToggleBtn' => FALSE
    )
);
$config['content_rp_rkp_desa'] = array(
    'colModel' => array(
        'id_m_rkp' => array('ID', 30, TRUE, 'center', 0),
        'id_m_rancangan_rpjm_desa' => array('ID RPJM', 30, TRUE, 'center', 0, 1),
        'rkp_tahun' => array('Tahun Anggaran', 100, TRUE, 'center', 2, 1),
        'bidang' => array('Bidang', 120, TRUE, 'center', 2),
        'jenis_kegiatan' => array('Jenis Kegiatan', 120, TRUE, 'center', 2),
        'lokasi' => array('Lokasi', 60, TRUE, 'center', 2),
        'volume' => array('Volume', 60, TRUE, 'center', 2),
        'sasaran_manfaat' => array('Sasaran Manfaat', 120, TRUE, 'center', 2),
        'waktu_pelaksanaan' => array('Waktu Pelaksanaan', 50, TRUE, 'center', 2),
        'jumlah_biaya' => array('Jumlah Biaya', 80, TRUE, 'right', 2),
        'pelaksanaan_swakelola' => array('Swakelola', 100, TRUE, 'center', 2),
        'pelaksanaan_kerjasama_antar_desa' => array('Kerjasama<br />Antar Desa', 100, TRUE, 'center', 2),
        'pelaksanaan_kerjasama_pihak_ketiga' => array('Kerjasama<br />Pihak Ketiga', 100, TRUE, 'center', 2),
        'rencana_pelaksanaan_kegiatan' => array('Rencana<br />Pelakasanaan<br />Kegiatan', 100, TRUE, 'center', 2)
        //'aksi' => array('Aksi', 120, FALSE, 'center', 0)
    ),
    'buttons' => array(
//        array('Select All', 'check', 'btn'),
//        array('separator'),
        array('Tambah Detail', 'add', 'btn'),
        array('separator'),
//        array('separator'),
//        array('Delete Selected Items', 'delete', 'btn'),
//        array('separator')
    ),
    'gridParams' => array(
        'height' => 300,
        'width' => 'auto',
        'usepager' => FALSE,
//        'rp' => 10,
//        'rpOptions' => '[10,20,30,40]', /* jumlah opsi untuk mengganti jumlah halaman */
//        'pagestat' => 'Displaying: {from} to {to} of {total} items.',
//        'blockOpacity' => 0.5,
        'title' => 'Detail RKP Desa',
        'showTableToggleBtn' => FALSE
    )
);