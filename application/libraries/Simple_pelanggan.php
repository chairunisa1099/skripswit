<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Simple_pelanggan{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        //load data model user
        $this->CI->load->model('pelanggan_model');
    }

    //fungsi login
    public function login($email, $password)
    {
        $check = $this->CI->pelanggan_model->login($email, $password);
        //jika ada data user, maka create session login
        if($check){
            $id_pelanggan   = $check->id_pelanggan;
            $nama_pelanggan = $check->nama_pelanggan;
        //create session
            $this->CI->session->set_userdata('id_pelanggan', $id_pelanggan);
            $this->CI->session->set_userdata('nama_pelanggan', $nama_pelanggan);
            $this->CI->session->set_userdata('email', $email);            
            //redirect ke hlmn admin yg diproteksi
            redirect(base_url('dashboard'), 'refresh');
        }
        else{
            //jika usernm/passw salah, maka login kembali
        $this->CI->session->set_flashdata('warning', 'Username atau Password Salah!');
        redirect(base_url('masuk'), 'refresh');
        }
    }

    
    //fungsi cek login
    public function cek_login()
    {
        // memeriksa apa session sdh ada/blm, jika blm dialihkan ke hlm login
        if($this->CI->session->userdata('email') == "") {
           $this->CI->session->set_flashdata('warning', 'Anda belum login');
            redirect(base_url('masuk'),'refresh');
        }
    }
    public function logout()
    {
        // membuang semua session yg tlah diset saat login
        $this->CI->session->unset_userdata('id_pelanggan');
        $this->CI->session->unset_userdata('nama_pelanggan');
        $this->CI->session->unset_userdata('email');
        // redirect ke login
        $this->CI->session->set_flashdata('sukses', 'Anda Berhasil Logout');
        redirect(base_url('masuk'), 'refresh');
    }
}