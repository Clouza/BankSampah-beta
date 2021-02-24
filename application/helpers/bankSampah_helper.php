<?php

// login access function
function check_log()
{
    // memanggil library CI
    $ci = get_instance();

    // cek login
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        // cek role
        $role = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        // cek menu
        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        // pencocokan
        $user_access = $ci->db->get_where('user_access_menu', ['role_id' => $role, 'menu_id' => $menu_id]);

        if ($user_access->num_rows() < 1) {
            redirect('auth/denied');
        }
    }
}

// access management function
function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    // query 
    $result = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
