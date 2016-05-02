<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/**
 * 
 * array('title', 'lebar kolom', ?, 'text alignment', ?)
 * array('Tahun Anggaran', 120, TRUE, 'center', 2);
 */

$config['array_total_top_coa'] = array(
    '1' => "total_pendapatan",
    '2' => "total_belanja",
    '3' => "total_pembiayaan"
);

$config['rp_apb_desa'] = array(
    'colModel' => array(
        'id_apbdes' => array('ID', 30, TRUE, 'center', 0),
        'id_m_apbdes' => array('ID M APBDES', 30, TRUE, 'center', 0, 1),
        'id_coa' => array('ID AKUN', 30, TRUE, 'center', 0, 1),
        'kode_rekening' => array('Kode Rekening', 250, TRUE, 'left', 2),
        'anggaran' => array('Anggaran', 100, TRUE, 'right', 2),
        'keterangan' => array('Keterangan', 220, TRUE, 'center', 2),
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
        'width' => 855,
        'usepager' => FALSE,
//        'rp' => 10,
//        'rpOptions' => '[10,20,30,40]', /* jumlah opsi untuk mengganti jumlah halaman */
//        'pagestat' => 'Displaying: {from} to {to} of {total} items.',
//        'blockOpacity' => 0.5,
        'title' => 'Detail APB Desa',
        'showTableToggleBtn' => FALSE
    )
);
$config['rp_master_apb_desa'] = array(
    'colModel' => array(
        'id_m_apbdes' => array('ID', 30, TRUE, 'center', 0),
        'id_m_rkp' => array('ID Master RKP', 30, TRUE, 'center', 0, 1),
        'rkp_tahun' => array('Tahun Anggaran', 90, TRUE, 'center', 0),
        'total_pendapatan' => array('Total Pendapatan', 100, TRUE, 'right', 2),
        'total_belanja' => array('Total Belanja', 120, TRUE, 'right', 2),
        'total_pembiayaan' => array('Total Pembayaran', 120, TRUE, 'right', 2),
        'tanggal_disetujui' => array('Tanggal Disetujui', 100, TRUE, 'center', 2, 1),
        'disetujui_oleh' => array('Disetujui Oleh<br />Kepala Desa', 100, TRUE, 'center', 2, 1),
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
        'title' => 'Master APB Desa',
//        'showTableToggleBtn' => FALSE
    )
);
