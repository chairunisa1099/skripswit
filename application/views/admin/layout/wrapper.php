<?php 
// proteksi hlm admin dgn fungsi cek login yg ada di simple_logim
$this->simple_login->cek_login();
//menggabungkan semua bagian layout

require_once('head.php');
require_once('header.php');
require_once('nav.php');
require_once('content.php');
require_once('footer.php');