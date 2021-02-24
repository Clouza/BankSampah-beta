<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
    public function nasabah()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // daftar user
        $data['users'] = $this->db->get('user')->result_array();

        // daftar bank model
        $this->load->model('Bank_model', 'bank_name');
        $data['banks'] = $this->bank_name->bank();

        $data['title'] = 'Nasabah';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/nasabah', $data);
        $this->load->view('templates/footer', $data);
    }

    // delete user
    public function deleteNSB($id)
    {
        // model
        $this->load->model('Bank_model', 'deleteNSB');
        $this->deleteNSB->nasabahDlt($id);

        // message
        $this->session->set_flashdata('message', 'Nasabah has been deleted!');

        redirect('master/nasabah');
    }

    // petugas
    public function petugas()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // model petugas bank
        $this->load->model('Bank_model', 'petugas');
        $data['banks'] = $this->petugas->bank();

        $data['title'] = 'Petugas';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/petugas', $data);
        $this->load->view('templates/footer', $data);
    }

    // delete petugas
    public function deletepetugas($id)
    {
        $this->db->delete('user', ['id' => $id]);

        $this->session->set_flashdata('message', 'Petugas has been deleted!');
        redirect('master/petugas');
    }
}
