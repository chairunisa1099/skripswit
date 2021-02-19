<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Belanja extends CI_Controller {

    // load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->model('kategori_model');
        $this->load->model('konfigurasi_model');
        $this->load->model('pelanggan_model');
        $this->load->model('header_transaksi_model');
        $this->load->model('transaksi_model');

        // load helper random string
        $this->load->helper('string');

    }

    // Halaman belanja
    public function index()
    {
       $keranjang = $this->cart->contents();

       $data = array(   'title'     => 'Keranjang Belanja',
                        'keranjang' => $keranjang,
                        'isi'       => 'belanja/list'
                    );
        $this->load->view('layout/wrapper', $data, FALSE);
    }

     // sukses belanja
     public function sukses()
     {
 
        $data = array(   'title'     => 'Belanja berhasil di proses',
                         'isi'       => 'belanja/sukses'
                     );
         $this->load->view('layout/wrapper', $data, FALSE);
     }

    // checkout
    public function checkout()
    {
        // cek pelanggan sdh login/blm, kalp blm harus daftar dl
        // cek dgn session email

        // if sdh login
        if($this->session->userdata('email')){
            $email              = $this->session->userdata('email');
            $nama_pelanggan     = $this->session->userdata('nama_pelanggan');
            $pelanggan          = $this->pelanggan_model->sudah_login($email, $nama_pelanggan);

            $keranjang          = $this->cart->contents();

             //validasi input
            $valid = $this->form_validation;

            $valid->set_rules('nama_pelanggan', 'Nama lengkap', 'required',
                    array('required' => '%s harus diisi'));

            $valid->set_rules('telepon', 'Nomor telepon', 'required',
            array('required' => '%s harus diisi'));
            
            $valid->set_rules('alamat', 'Alamat Lengkap', 'required',
            array('required' => '%s harus diisi'));

            $valid->set_rules('email', 'Email', 'required|valid_email',
                    array('required'     => '%s harus diisi', 
                        'valid_email'  => '%s tidak valid'));          
            
            if($valid->run()===FALSE) {
            //end validasi

            $data   = array(    'title'     => 'Checkout',
                                'keranjang' => $keranjang,
                                'pelanggan' => $pelanggan,
                                'isi'       => 'belanja/checkout'
                            );
            $this->load->view('layout/wrapper', $data, FALSE);
            // masuk db
            }else{
                $i = $this->input;
                $data = array(  'id_pelanggan'          => $pelanggan->id_pelanggan,
                                'nama_pelanggan'        => $i->post('nama_pelanggan'),
                                'email'                 => $i->post('email'),                                
                                'telepon'               => $i->post('telepon'),
                                'alamat'                => $i->post('alamat'),
                                'kode_transaksi'        => $i->post('kode_transaksi'), 
                                'tanggal_transaksi'     => $i->post('tanggal_transaksi'),
                                'jumlah_transaksi'      => $i->post('jumlah_transaksi'),
                                'status_bayar'          =>'Belum',
                                'tanggal_post'          => date('Y-m-d H:i:s')
                                );
            // masuk ke header transaksi
            $this->header_transaksi_model->tambah($data);
            // masuk ke tabel transaksi
            foreach($keranjang as $keranjang) {
                $sub_total  = $keranjang['price'] = $keranjang['qty'];

                $data       = array('id_pelanggan'      => $pelanggan->id_pelanggan,
                                    'kode_transaksi'    => $i->post('kode_transaksi'), 
                                    'id_produk'         => $keranjang['id'],
                                    'harga'             => $keranjang['price'],
                                    'jumlah'            => $keranjang['qty'],
                                    'total_harga'       => $sub_total,
                                    'tanggal_transaksi' => $i->post('tanggal_transaksi')
                                    );
                $this->transaksi_model->tambah($data);
            }
            // end proses masuk ke tabel transaksi

            // stlh masuk ke tabel transaksi, keranjang dikosongkan
            $this->cart->destroy();
            // end destroy keranjang
            $this->session->set_flashdata('sukses', 'Checkout berhasil');
            redirect(base_url('belanja/sukses'),'refresh');
            }
            //end masuk database
        }else{
            // klo blm hrs regist
            $this->session->set_flashdata('sukses', 'Silahkan login atau registrasi terlebih dahulu');
            redirect(base_url('registrasi'), 'refresh');
    }
}


    // tambah ke keranjang belanja
    public function add()
    {
        // ambil data dari form
        $id             = $this->input->post('id');
        $qty            = $this->input->post('qty');
        $price          = $this->input->post('price');
        $name           = $this->input->post('name');
        $redirect_page  = $this->input->post('redirect_page');
        // proses masuk ke keranjang
        $data   = array(    'id'    => $id,
                            'qty'   => $qty,
                            'price' => $price,
                            'name'  => $name
                        );
        $this->cart->insert($data);
        // redirect page
        redirect($redirect_page, 'refresh');
    }

    // update keranjang
    public function update_cart($rowid)
    {
        // jika ada data rowid
        if($rowid){
            $data = array(  'rowid'     => $rowid,
                            'qty'       => $this->input->post('qty')
                         );
            $this->cart->update($data);
            $this->session->set_flashdata('sukses', 'Data keranjang telah diupdate');
            redirect(base_url('belanja'), 'refresh');
        }else{
            // jika tidak ada row id
            redirect(base_url('belanja'), 'refresh');
        }
    }

    // hapus isi keranjang
    public function hapus($rowid)
    {
        if($rowid) {  
        // hapus per item
        $this->cart->remove($rowid);
        $this->session->set_flashdata('sukses', 'Data keranjang belanja telah dihapus');
        redirect(base_url('belanja'), 'refresh');
        }else{
        // hapus all
        $this->cart->destroy();
        $this->session->set_flashdata('sukses', 'Data keranjang belanja telah dihapus');
        redirect(base_url('belanja'), 'refresh');
    }
}
}