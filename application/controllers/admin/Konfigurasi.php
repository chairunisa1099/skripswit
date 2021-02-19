<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('konfigurasi_model');
      
    }
    // konf umum
    public function index()
    {
        $konfigurasi = $this->konfigurasi_model->listing();
        
        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('namaweb', 'Nama website', 'required',
                array('required' => '%s harus diisi'));           
        
        if($valid->run()===FALSE) {
        //end validasi

        $data = array('title'       =>'Konfigurasi Web',
                      'konfigurasi' => $konfigurasi,
                      'isi'         =>'admin/konfigurasi/list'
                    );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
        //masuk database
        }else{
            $i = $this->input;
            $data = array('id_konfigurasi'      => $konfigurasi->id_konfigurasi,
                        'namaweb'               => $i->post('namaweb'),
                        'tagline'               => $i->post('tagline'),
                        'email'                 => $i->post('email'),
                        'website'               => $i->post('website'),
                        'keywords'              => $i->post('keywords'),
                        'metatext'              => $i->post('metatext'),
                        'telepon'               => $i->post('telepon'),
                        'alamat'                => $i->post('alamat'),
                        'facebook'              => $i->post('facebook'),
                        'instagram'             => $i->post('instagram'),
                        'deskripsi'             => $i->post('deskripsi'),
                        'rekening_pembayaran'   => $i->post('rekening_pembayaran'),
        );
        $this->konfigurasi_model->edit($data);
        $this->session->set_flashdata('sukses', 'Data telah diupdate');
        redirect(base_url('admin/konfigurasi'),'refresh');
       }
    }
    

    // konf logo
    public function logo()
    {
        $konfigurasi = $this->konfigurasi_model->listing();
        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('namaweb', 'Nama Website', 'required',
                    array('required' => '%s harus diisi')); 
        
        if($valid->run()) {
            // JIKA GAMBAR DIGANTI
            if(!empty($_FILES['logo']['name'])) {

            $config['upload_path']      = './assets/upload/image/';
            $config['allowed_types']    = 'gif|jpg|jpeg|png';
            $config['max_size']         = '2400'; //kb
            $config['max_width']        = '2400';
            $config['max_height']       = '2400';
            
            $this->load->library('upload', $config);
           
            if ( ! $this->upload->do_upload('logo')){                 
            // end validasi

        $data = array('title'     => 'Konfigurasi Logo Web',
                    'konfigurasi' => $konfigurasi,
                    'error'       => $this->upload->display_errors(),
                    'isi'         =>'admin/konfigurasi/logo'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
        }else{
            $upload_gambar = array('upload_data' => $this->upload->data());

            // create thumbnail gbr
            $config['image_library']    = 'gd2';
            $config['source_image']     = './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
            // loc folder thumbnail
            $config['new_image']        = './assets/upload/image/thumbs/';
            $config['create_thumb']     = TRUE;
            $config['maintain_ratio']   = TRUE;
            $config['width']            = 250;
            $config['height']           = 250;
            $config['thumb_marker']     = '';

            $this->load->library('image_lib', $config);

            $this->image_lib->resize();

            // end create thumbnail

            $i = $this->input;
            $data = array('id_konfigurasi'     => $konfigurasi->id_konfigurasi,
                            'namaweb'          => $i->post('namaweb'),
                            'logo'             => $upload_gambar['upload_data']['file_name'],
                            );
            $this->konfigurasi_model->edit($data);
            $this->session->set_flashdata('sukses', 'Data telah diedit');
            redirect(base_url('admin/konfigurasi/logo'),'refresh');

        }} else{
        // EDIT TANPA GANTI GAMBAR
        $i = $this->input;
        $data = array('id_konfigurasi'   => $konfigurasi->id_konfigurasi,
                      'namaweb'          => $i->post('namaweb'),
                      // 'logo'          => $upload_gambar['upload_data']['file_name'],
                    );
        $this->konfigurasi_model->edit($data);
        $this->session->set_flashdata('sukses', 'Data telah diedit');
        redirect(base_url('admin/konfigurasi/logo'),'refresh');

        }}
            
        $data = array('title'     => 'Konfigurasi Logo Web',
                    'konfigurasi' => $konfigurasi,
                    'isi'         =>'admin/konfigurasi/logo'
                );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function icon()
    {
        $konfigurasi = $this->konfigurasi_model->listing();
        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('namaweb', 'Nama Website', 'required',
                    array('required' => '%s harus diisi')); 
        
        if($valid->run()) {
            // JIKA GAMBAR DIGANTI
            if(!empty($_FILES['icon']['name'])) {

            $config['upload_path']      = './assets/upload/image/';
            $config['allowed_types']    = 'gif|jpg|jpeg|png';
            $config['max_size']         = '2400'; //kb
            $config['max_width']        = '2400';
            $config['max_height']       = '2400';
            
            $this->load->library('upload', $config);
           
            if ( ! $this->upload->do_upload('icon')){                 
            // end validasi

        $data = array('title'     => 'Konfigurasi Icon Web',
                    'konfigurasi' => $konfigurasi,
                    'error'       => $this->upload->display_errors(),
                    'isi'         =>'admin/konfigurasi/icon'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
        }else{
            $upload_gambar = array('upload_data' => $this->upload->data());

            // create thumbnail gbr
            $config['image_library']    = 'gd2';
            $config['source_image']     = './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
            // loc folder thumbnail
            $config['new_image']        = './assets/upload/image/thumbs/';
            $config['create_thumb']     = TRUE;
            $config['maintain_ratio']   = TRUE;
            $config['width']            = 250;
            $config['height']           = 250;
            $config['thumb_marker']     = '';

            $this->load->library('image_lib', $config);

            $this->image_lib->resize();

            // end create thumbnail

            $i = $this->input;
            $data = array('id_konfigurasi'   => $konfigurasi->id_konfigurasi,
                          'namaweb'          => $i->post('namaweb'),
                          'icon'             => $upload_gambar['upload_data']['file_name'],
                            );
            $this->konfigurasi_model->edit($data);
            $this->session->set_flashdata('sukses', 'Data telah diedit');
            redirect(base_url('admin/konfigurasi/icon'),'refresh');

        }} else{
        // EDIT TANPA GANTI GAMBAR
        $i = $this->input;
        $data = array('id_konfigurasi'   => $konfigurasi->id_konfigurasi,
                      'namaweb'          => $i->post('namaweb'),
                      // 'logo'          => $upload_gambar['upload_data']['file_name'],
                    );
        $this->konfigurasi_model->edit($data);
        $this->session->set_flashdata('sukses', 'Data telah diedit');
        redirect(base_url('admin/konfigurasi/icon'),'refresh');

        }}
            
        $data = array('title'     => 'Konfigurasi Icon Web',
                    'konfigurasi' => $konfigurasi,
                    'isi'         =>'admin/konfigurasi/icon'
                );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

}