<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    // load model
    public function __construct()
    {
        parent::__construct();
        // proteksi hlmn
        $this->simple_login->cek_login();
    }
    // Halaman Login
    public function index()
    {
        $data = array( 'title' => 'Halaman Admin',
                       'isi'   => 'admin/dashboard/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }
}