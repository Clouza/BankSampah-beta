<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // cek user login
        check_log();
    }

    public function tabungan()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Tabungan';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/tabungan', $data);
        $this->load->view('templates/footer', $data);
    }

    public function penarikan()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // modal penarikan
        $this->load->model('Bank_model', 'penarikan');
        $data['users'] = $this->penarikan->penarikanModel();


        $data['title'] = 'Penarikan';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/penarikan', $data);
        $this->load->view('templates/footer', $data);
    }

    // tarik saldo
    public function withdraw()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $saldo = $this->input->post('saldo');

        // 10k
        if ($saldo == 'sepuluh') {
            if ($data['user']['saldo'] < 10000) {
                $this->session->set_flashdata('message', 'Saldo anda kurang!');

                redirect('transaksi/tabungan');
            } else {

                $updateSaldo = $data['user']['saldo'] - 10000;

                // transaction start
                $this->db->trans_start();

                // update data
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // insert data
                $data = [
                    'date' => time(),
                    'user_id' => $data['user']['id'],
                    'total' => 10000
                ];

                $this->db->insert('penarikan', $data);

                // transaction end
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo berhasil ditarik!');
                redirect('transaksi/tabungan');
            }
        }

        // 20k
        if ($saldo == 'duapuluh') {
            if ($data['user']['saldo'] < 20000) {
                $this->session->set_flashdata('message', 'Saldo anda kurang!');

                redirect('transaksi/tabungan');
            } else {
                $updateSaldo = $data['user']['saldo'] - 20000;

                // transaction start
                $this->db->trans_start();

                // update data
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // insert data
                $data = [
                    'date' => time(),
                    'user_id' => $data['user']['id'],
                    'total' => 20000
                ];

                $this->db->insert('penarikan', $data);

                // transaction end
                $this->db->trans_complete();


                $this->session->set_flashdata('messagee', 'Saldo berhasil ditarik!');
                redirect('transaksi/tabungan');
            }
        }

        // 50k
        if ($saldo == 'limapuluh') {
            if ($data['user']['saldo'] < 50000) {
                $this->session->set_flashdata('message', 'Saldo anda kurang!');

                redirect('transaksi/tabungan');
            } else {
                $updateSaldo = $data['user']['saldo'] - 50000;

                // transaction start
                $this->db->trans_start();

                // update data
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // insert data
                $data = [
                    'date' => time(),
                    'user_id' => $data['user']['id'],
                    'total' => 50000
                ];

                $this->db->insert('penarikan', $data);

                // transaction end
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo berhasil ditarik!');
                redirect('transaksi/tabungan');
            }
        }

        $this->session->set_flashdata('message', 'Pilih nominal!');
        redirect('transaksi/tabungan');
    }

    // setoran
    public function setoran()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Setoran';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/setoran', $data);
        $this->load->view('templates/footer', $data);
    }

    // setoran tingkat lanjut
    public function setoran2()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // model all user
        $this->load->model('bank_model', 'users');
        $data['admin'] = $this->users->admin();

        // post nama barang
        $namaBarang = $this->input->post('namaBarang');

        // satuan 
        $jumlah_satuan = $this->input->post('jumlah');
        $satuan = $this->input->post('satuan');

        // post jenis & kode
        $jenis = $this->input->post('jenis');
        $kode = $this->input->post('kode');

        // biaya admin
        $biayaAdmin = 0.02;
        $saldoAdmin = 50;
        $updateSaldoAdmin = $data['admin']['saldo'] + $saldoAdmin;
        // $updateSaldoAdmin = $saldoAdmin;

        // plastik
        if ($jenis == 'plastik') {
            if ($kode == 'pls') {
                // harga 
                $hargaJual = 500;
                $hargaBeli = 100;
                $hargaPilah = 0;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'plk') {
                // harga 
                $hargaJual = 300;
                $hargaBeli = 150;
                $hargaPilah = 75;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'plc') {

                // harga 
                $hargaJual = 100;
                $hargaBeli = 50;
                $hargaPilah = 25;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'plb') {

                // harga 
                $hargaJual = 1000;
                $hargaBeli = 500;
                $hargaPilah = 250;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'pes') {

                // harga 
                $hargaJual = 400;
                $hargaBeli = 200;
                $hargaPilah = 100;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else {
                echo "salah pilih! cek syarat dan ketentuan penyetoran!";
            }
        }

        // PET
        if ($jenis == 'pet') {
            if ($kode == 'pet') {
                // harga 
                $hargaJual = 1000;
                $hargaBeli = 500;
                $hargaPilah = 0;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'pbb') {

                // harga 
                $hargaJual = 3000;
                $hargaBeli = 1500;
                $hargaPilah = 750;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'pbm') {

                // harga 
                $hargaJual = 2600;
                $hargaBeli = 1300;
                $hargaPilah = 650;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'pbw') {

                // harga 
                $hargaJual = 1000;
                $hargaBeli = 500;
                $hargaPilah = 250;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'pbt') {
                // harga 
                $hargaJual = 2000;
                $hargaBeli = 1000;
                $hargaPilah = 500;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'pba') {
                // harga 
                $hargaJual = 1000;
                $hargaBeli = 500;
                $hargaPilah = 250;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'gab') {
                // harga 
                $hargaJual = 2500;
                $hargaBeli = 1250;
                $hargaPilah = 625;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else {
                echo "salah pilih! cek syarat dan ketentuan penyetoran!";
            }
        }

        // besi bekas
        if ($jenis == 'besi') {
            if ($kode == 'bbk') {
                // harga 
                $hargaJual = 800;
                $hargaBeli = 400;
                $hargaPilah = 0;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'bbb') {
                // harga 
                $hargaJual = 2000;
                $hargaBeli = 1000;
                $hargaPilah = 500;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'alm') {
                // harga 
                $hargaJual = 9000;
                $hargaBeli = 4500;
                $hargaPilah = 2250;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'omp') {
                // harga 
                $hargaJual = 800;
                $hargaBeli = 400;
                $hargaPilah = 200;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else {
                echo "salah pilih! cek syarat dan ketentuan penyetoran!";
            }
        }

        // kardus 
        if ($jenis == 'kardus') {
            if ($kode == 'krt') {
                // harga 
                $hargaJual = 1000;
                $hargaBeli = 150;
                $hargaPilah = 0;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'hvs') {
                // harga 
                $hargaJual = 1000;
                $hargaBeli = 500;
                $hargaPilah = 250;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'kbr') {
                // harga 
                $hargaJual = 700;
                $hargaBeli = 350;
                $hargaPilah = 175;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'dpl') {
                // harga 
                $hargaJual = 300;
                $hargaBeli = 150;
                $hargaPilah = 75;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'krd') {
                // harga 
                $hargaJual = 1700;
                $hargaBeli = 850;
                $hargaPilah = 425;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else {
                echo "salah pilih! cek syarat dan ketentuan penyetoran!";
            }
        }

        // kaleng
        if ($jenis == 'kaleng') {
            if ($kode == 'klg') {
                // harga 
                $hargaJual = 1000;
                $hargaBeli = 500;
                $hargaPilah = 0;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'kol') {
                // harga 
                $hargaJual = 2000;
                $hargaBeli = 1000;
                $hargaPilah = 500;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'jrg') {
                // harga 
                $hargaJual = 3000;
                $hargaBeli = 1500;
                $hargaPilah = 750;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'emp') {
                // harga 
                $hargaJual = 1000;
                $hargaBeli = 500;
                $hargaPilah = 250;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else {
                echo "salah pilih! cek syarat dan ketentuan penyetoran!";
            }
        }

        // botol kaca
        if ($jenis == 'botol kaca') {
            if ($kode == 'btl') {
                // harga 
                $hargaJual = 400;
                $hargaBeli = 200;
                $hargaPilah = 0;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'bbb') {
                // harga 
                $hargaJual = 700;
                $hargaBeli = 350;
                $hargaPilah = 175;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'bbk') {
                // harga 
                $hargaJual = 400;
                $hargaBeli = 200;
                $hargaPilah = 100;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else {
                echo "salah pilih! cek syarat dan ketentuan penyetoran!";
            }
        }

        // lain - lain
        if ($jenis == 'lain lain') {
            if ($kode == 'mjl') {
                // harga 
                $hargaJual = 2500;
                $hargaBeli = 1250;
                $hargaPilah = 625;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else if ($kode == 'mgt') {
                // harga 
                $hargaJual = 2000;
                $hargaBeli = 1000;
                $hargaPilah = 500;

                // transaction
                $this->db->trans_start();

                // saldo
                $updateSaldo = $data['user']['saldo'] + $hargaBeli * $jumlah_satuan * $biayaAdmin - $hargaPilah;

                // insert data to table 'setoran'
                $setor_table = [
                    'user_id' => $data['user']['id'],
                    'tanggal' => time(),
                    'nama_sampah' => $namaBarang,
                    'kode_sampah' => $kode,
                    'jumlah_satuan' => $jumlah_satuan,
                    'satuan' => $satuan,
                    'setoran_jumlah' => $hargaBeli * $jumlah_satuan,
                    'jual_jumlah' => $hargaJual * $jumlah_satuan,
                    'biaya_admin' => $saldoAdmin
                ];
                $this->db->insert('setoran', $setor_table);

                // update data user
                $this->db->set('saldo', $updateSaldo);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');

                // update data admin
                if ($data['user']['role_id'] == 1) {
                    // admin tidak terpengaruh pajak :)
                    $notDec = $updateSaldo;

                    // jika login = admin 
                    $this->db->set('saldo', $notDec);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');
                } else {
                    // update saldo admin :)
                    $this->db->set('saldo', $updateSaldoAdmin);
                    $this->db->where('role_id', 1);
                    $this->db->update('user');
                }

                // end transaction
                $this->db->trans_complete();

                $this->session->set_flashdata('messagee', 'Saldo sudah terisi!');
                redirect('transaksi/tabungan');
            } else {
                echo "salah pilih! cek syarat dan ketentuan penyetoran!";
            }
        }
    }

    // penjualan
    public function penjualan()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $penjualan = "SELECT * FROM setoran";
        $data['penjualan'] = $this->db->query($penjualan)->result_array();

        $data['title'] = 'Penjualan';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/penjualan', $data);
        $this->load->view('templates/footer', $data);
    }
}
