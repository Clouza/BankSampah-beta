<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank_model extends CI_Model
{
    // get submenu from table
    public function getSubMenu($limit, $start, $keyword = null)
    {
        if ($keyword) {
            // join table
            // table user_sub_menu
            $this->db->select('user_sub_menu.*');

            // table user_menu
            $this->db->select('user_menu.menu');

            // from
            $this->db->from('user_sub_menu');

            $this->db->join('user_menu', 'user_sub_menu.menu_id = user_menu.id');

            // limit and offset
            $this->db->limit($limit, $start);

            // keyword 
            $this->db->like('title', $keyword);
            $this->db->or_like('menu', $keyword);
            $this->db->or_like('url', $keyword);
            $this->db->or_like('icon', $keyword);
        } else {
            // $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu` FROM `user_sub_menu` JOIN `user_menu` ON `user_sub_menu`.`menu_id` = `user_menu`.`id` LIMIT $limit OFFSET $start";

            // join table
            // table user_sub_menu
            $this->db->select('user_sub_menu.*');

            // table user_menu
            $this->db->select('user_menu.menu');

            // from
            $this->db->from('user_sub_menu');

            $this->db->join('user_menu', 'user_sub_menu.menu_id = user_menu.id');

            // limit
            $this->db->limit($limit, $start);
        }

        return $this->db->get()->result_array();
    }

    // delete submenu
    public function deleteSub($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
    }

    // delete nasabah
    public function nasabahDlt($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
    }

    // delete role
    public function deleteRole($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_role');
    }

    // bank name
    public function bank()
    {
        $query = "SELECT `user`.*, `bank_sampah`.`nama_bank` FROM `user` JOIN `bank_sampah` ON `user`.`bank_id` = `bank_sampah`.`id`";

        return $this->db->query($query)->result_array();
    }

    // all users
    public function users($limit, $start)
    {
        // $query = "SELECT `user`.*, `user_role`.`role`, `bank_sampah`.`nama_bank` FROM `user` JOIN `user_role` JOIN `bank_sampah` ON `user`.`role_id` = `user_role`.`id` AND `user`.`bank_id` = `bank_sampah`.`id`";

        // return $this->db->query($query)->result_array();

        // join
        $this->db->select('user.*');
        $this->db->select('user_role.role');
        $this->db->select('bank_sampah.nama_bank');
        $this->db->from('user');
        $this->db->join('user_role', 'user.role_id = user_role.id');
        $this->db->join('bank_sampah', 'user.bank_id = bank_sampah.id');

        // limit and offset
        $this->db->limit($limit, $start);

        return $this->db->get()->result_array();
    }

    // penarikan
    public function penarikanModel()
    {
        // $query = "SELECT `user`.*, `penarikan`.`user_id` FROM `user` JOIN `penarikan` ON `user`.`id` = `penarikan`.`user_id`";
        $query = "SELECT `penarikan`.*, `user`.`id` FROM `penarikan` JOIN `user` ON `penarikan`.`user_id` = `user`.`id`";

        return $this->db->query($query)->result_array();
    }

    // admin
    public function admin()
    {
        $query = "SELECT * FROM user WHERE role_id = 1";

        return $this->db->query($query)->row_array();
    }

    // role
    public function role()
    {
        $query = "SELECT * FROM user_role ";
        // $query = "SELECT `user`.*, `user_role`.`role` FROM `user` JOIN `user_role` ON `user`.`role_id` = `user_role`.`id`";

        return $this->db->query($query)->result_array();
    }

    // edit user
    public function editUsers($id)
    {
        // data
        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'telp' => $this->input->post('telp'),
            'role_id' => $this->input->post('role')
        ];

        // set data
        $this->db->set($data);

        // update data
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user');
    }

    // petugas
    public function petugas()
    {
        $query = "SELECT `user`.*, `user_role`.`role`, `bank_sampah`.`nama_bank` FROM `user` JOIN `user_role` JOIN `bank_sampah` ON `user`.`role_id` = `user_role`.`id` AND `user`.`bank_id` = `bank_sampah`.`id`";
    }

    // penjualan
    public function penjualan($limit, $start)
    {
        // join
        $this->db->select('setoran.*');
        $this->db->select('user.name');
        $this->db->from('setoran');
        $this->db->join('user', 'user.id = setoran.user_id');

        // limit and offset
        $this->db->limit($limit, $start);

        return $this->db->get()->result_array();
    }
}
