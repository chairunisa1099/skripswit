<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('header_transaksi_model');
        $this->load->model('transaksi_model');
        // proteksi hlmn
        $this->simple_login->cek_login();
    }

    // data trans
    public function index()
    {
        $header_transaksi = $this->header_transaksi_model->listing();
        $data = array(  'title'     => 'Data Transaksi',
                        'transaksi' => $header_transaksi,
                        'isi'       => 'admin/transaksi/list'
                    );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

}