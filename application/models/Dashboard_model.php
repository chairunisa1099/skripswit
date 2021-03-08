<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // total produk
    public function total_produk()
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('produk');
        $query = $this->db->get();
        return $query->row();
    }

    // customer
    public function total_pelanggan()
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('pelanggan');
        $query = $this->db->get();
        return $query->row();
    }

    
    // total transaksi
    public function total_header_transaksi()
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('header_transaksi');
        $query = $this->db->get();
        return $query->row();
    }

    // total transaksi
    public function total_transaksi()
    {
        $this->db->select('SUM(transaksi.total_harga) AS total');
        $this->db->from('transaksi');
        $this->db->join('header_transaksi', 'header_transaksi.kode_transaksi = transaksi.kode_transaksi');

        $query = $this->db->get();
        return $query->row();
    }

 
}