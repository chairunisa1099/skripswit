<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Simple_login{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        //load data model user
        $this->CI->load->model('user_model');
    }

    //fungsi login
    public function login($username, $password)
    {
        $check = $this->CI->user_model->login($username, $password);
        //jika ada data user, maka create session login
        if($check){
            $id_user        = $check->id_user;
            $nama           = $check->nama;
            $akses_level    = $check->akses_level;
        //create session
            $this->CI->session->set_userdata('id_user', $id_user);
            $this->CI->session->set_userdata('nama', $nama);
            $this->CI->session->set_userdata('username', $username);
            $this->CI->session->set_userdata('akses_level', $akses_level);
            //redirect ke hlmn admin yg diproteksi
            redirect(base_url('admin/dashboard'), 'refresh');
        }
        else{
            //jika usernm/passw salah, maka login kembali
        $this->CI->session->set_flashdata('warning', 'Username atau Password Salah!');
        redirect(base_url('login'), 'refresh');
        }
    }

    
    //fungsi cek login
    public function cek_login()
    {
        // memeriksa apa session sdh ada/blm, jika blm dialihkan ke hlm login
        if($this->CI->session->userdata('username') == "") {
           $this->CI->session->set_flashdata('warning', 'Anda belum login');
            redirect(base_url('login'),'refresh');
        }
    }
    public function logout()
    {
        // membuang semua session yg tlah diset saat login
        $this->CI->session->unset_userdata('id_user');
        $this->CI->session->unset_userdata('nama');
        $this->CI->session->unset_userdata('username');
        $this->CI->session->unset_userdata('akses_level');
        // redirect ke login
        $this->CI->session->set_flashdata('sukses', 'Anda Berhasil Logout');
        redirect(base_url('login'), 'refresh');
    }
}