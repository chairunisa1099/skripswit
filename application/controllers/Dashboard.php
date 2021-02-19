<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    // load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pelanggan_model');
        $this->load->model('header_transaksi_model');
        $this->load->model('transaksi_model');
        $this->simple_pelanggan->cek_login();
    }

    // Halaman utama web
    public function index()
    {
        $id_pelanggan       = $this->session->userdata('id_pelanggan');
        $header_transaksi   = $this->header_transaksi_model->pelanggan($id_pelanggan);

        $data = array(  'title'      => 'Halaman Dashboard Pelanggan',
                        'header_transaksi'  => $header_transaksi,
                        'isi'        => 'dashboard/list'
                    );
        $this->load->view('layout/wrapper', $data, FALSE);
    }

    // belanja
    public function belanja()
    {
        // ambil data login id_pelanggan
        $id_pelanggan       = $this->session->userdata('id_pelanggan');
        $header_transaksi   = $this->header_transaksi_model->pelanggan($id_pelanggan);

        $data = array(  'title'             => 'Riwayat Belanja',
                        'header_transaksi'  => $header_transaksi,
                        'isi'               => 'dashboard/belanja'
                    );
        $this->load->view('layout/wrapper', $data, FALSE);
    }

    // detail
    public function detail($kode_transaksi)
    {
        // ambil data login id_pelanggan
        $id_pelanggan       = $this->session->userdata('id_pelanggan');
        $header_transaksi   = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
        $transaksi          = $this->transaksi_model->kode_transaksi($kode_transaksi);    
        
        if($header_transaksi->id_pelanggan != $id_pelanggan) {
            $this->session->set_flashdata('warning', 'Anda mencoba mengakses data transaksi orang lain');
            redirect(base_url('masuk'));
        }
        $data = array(  'title'             => 'Riwayat Belanja',
                        'header_transaksi'  => $header_transaksi,
                        'transaksi'         => $transaksi,
                        'isi'               => 'dashboard/detail'
                    );
        $this->load->view('layout/wrapper', $data, FALSE);
    }

    // profil
    public function profil()
    {
        $id_pelanggan       = $this->session->userdata('id_pelanggan');
        $pelanggan          = $this->pelanggan_model->detail($id_pelanggan);

        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('nama_pelanggan', 'Nama lengkap', 'required',
                array('required' => '%s harus diisi'));
        $valid->set_rules('alamat', 'Alamat Lengkap', 'required',
                array('required' => '%s harus diisi'));
        $valid->set_rules('telepon', 'Nomor Telepon', 'required',
        array('required' => '%s harus diisi'));
        
        
        if($valid->run()===FALSE) {
        //end validasi
        
        $data = array(  'title'             => 'Profil Saya',
                        'pelanggan'         => $pelanggan,
                        'isi'               => 'dashboard/profil'
                    );
        $this->load->view('layout/wrapper', $data, FALSE);
        //masuk database
        }else{
            $i = $this->input;
            
            if(strlen($i->post('password')) >= 6) {
                $data = array(  'id_pelanggan'          => $id_pelanggan,
                                'nama_pelanggan'        => $i->post('nama_pelanggan'),                            
                                'password'              => $i->post('password'),
                                'telepon'               => $i->post('telepon'),
                                'alamat'                => $i->post('alamat')                        
                        );
            }else{
                $data = array(  'id_pelanggan'          => $id_pelanggan,
                                'nama_pelanggan'        => $i->post('nama_pelanggan'),                            
                                'telepon'               => $i->post('telepon'),
                                'alamat'                => $i->post('alamat')                        
                        );
            }
        // end data apdet
        $this->pelanggan_model->edit($data);
        $this->session->set_flashdata('sukses', 'Update Profil berhasil');
        redirect(base_url('dashboard/profil'),'refresh');
    }
        //end masuk database

    }

}