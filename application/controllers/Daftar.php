<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // cek user login
        check_log();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Daftar Harga';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('daftar/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function bankSampah()
    {
        // table user
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // table bank sampah
        $data['bank'] = $this->db->get_where('bank_sampah')->result_array();

        $data['title'] = 'Bank Sampah';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('daftar/bankSampah', $data);
        $this->load->view('templates/footer', $data);
    }
}
