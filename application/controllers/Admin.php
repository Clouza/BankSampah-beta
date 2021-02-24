<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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

        // user active
        $data['userActive'] = $this->db->get_where('user', ['is_active' => 1])->num_rows();

        // jumlah nasabah
        $data['nasabah'] = $this->db->get_where('user', ['role_id' => 2])->num_rows();

        // jumlah petugas
        $data['petugas'] = $this->db->get_where('user', ['role_id' => 12])->num_rows();

        // administrasi
        $data['admin'] = $this->db->get_where('user', ['role_id' => 1])->row_array();

        // setoran
        $data['setoran'] = $this->db->get('setoran')->num_rows();

        // penarikan
        $data['penarikan'] = $this->db->get('penarikan')->num_rows();

        // penjualan
        $data['penjualan'] = $this->db->get_where('setoran', ['is_sold' => 1])->num_rows();

        $data['title'] = 'Dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function submenu()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // user menu
        $data['menu'] = $this->db->get('user_menu')->result_array();

        // unset keyword
        if (isset($_POST['refresh'])) {
            $this->session->unset_userdata('keyword');
        }

        // ambil data keyword
        if (isset($_POST['submit'])) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        // var_dump($data['keyword']);

        if ($this->form_validation->run() == false) {

            // pagination
            $this->db->like('title', $data['keyword']);
            $this->db->or_like('url', $data['keyword']);
            $this->db->or_like('icon', $data['keyword']);
            $this->db->from('user_sub_menu');

            // $count = $this->db->get('user_sub_menu')->num_rows();
            $config['base_url'] = base_url('admin/submenu');
            $config['total_rows'] = $this->db->count_all_results();
            // $config['total_rows'] = $count;

            // var_dump($config['total_rows']);
            // $this->session->set_flashdata('foundQuery', $config['total_rows']);
            $config['per_page'] = 5;

            // initialize
            $this->pagination->initialize($config);

            // base_url('admin/submenu/(segment 3)')
            $data['start'] = $this->uri->segment(3);

            // model for submenu
            $this->load->model('Bank_model', 'menu');
            $data['sub_menu'] = $this->menu->getSubMenu($config['per_page'], $data['start'], $data['keyword']);

            $data['title'] = 'Submenu Management';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/submenu', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // insert to database
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);

            $this->session->set_flashdata('message', 'GG! New Submenu has been added!');

            redirect('admin/submenu');
        }
    }

    // add submenu
    public function addsubmenu()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('title', 'Sub Menu', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        // user menu
        $data['menu'] = $this->db->get('user_menu')->result_array();

        // unset keyword
        if (isset($_POST['refresh'])) {
            $this->session->unset_userdata('keyword');
        }

        // ambil data keyword
        if (isset($_POST['submit'])) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        if ($this->form_validation->run() == false) {
            // pagination
            $this->db->like('title', $data['keyword']);
            $this->db->or_like('url', $data['keyword']);
            $this->db->or_like('icon', $data['keyword']);
            $this->db->from('user_sub_menu');

            // $count = $this->db->get('user_sub_menu')->num_rows();

            $config['total_rows'] = $this->db->count_all_results();
            // $config['total_rows'] = $count;

            // var_dump($config['total_rows']);
            // $this->session->set_flashdata('foundQuery', $config['total_rows']);
            $config['per_page'] = 5;

            // initialize
            $this->pagination->initialize($config);

            // base_url('admin/submenu/(segment 3)')
            $data['start'] = $this->uri->segment(3);

            // model for submenu
            $this->load->model('Bank_model', 'menu');
            $data['sub_menu'] = $this->menu->getSubMenu($config['per_page'], $data['start'], $data['keyword']);

            $data['title'] = 'Submenu Management';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/submenu', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // insert to database
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);

            $this->session->set_flashdata('message', 'GG! New Submenu has been added!');

            redirect('admin/submenu');
        }
    }

    // edit submenu
    public function editsubmenu($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // find spec submenu
        $submenuSelect = "SELECT * FROM user_sub_menu WHERE id = $id";
        $submenu = $this->db->query($submenuSelect)->row_array();
        $data['submenu'] = $submenu;

        // submenu = menu
        $menuSelect = "SELECT * FROM user_menu";
        $menu = $this->db->query($menuSelect)->result_array();
        $data['menu'] = $menu;

        // post
        $name = $this->input->post('name');
        $menu = $this->input->post('menu');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $is_active = $this->input->post('is_active');

        // set rules
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('url', 'Url', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Submenu';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/editsubmenu', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // data active
            $dataActive = [
                'menu_id' => $menu,
                'title' => $name,
                'url' => $url,
                'icon' => $icon,
                'is_active' => 1,
            ];

            // data not active
            $dataNotActive = [
                'menu_id' => $menu,
                'title' => $name,
                'url' => $url,
                'icon' => $icon,
                'is_active' => 0,
            ];

            // update
            if ($is_active == 1) {
                $this->db->set($dataActive);
                $this->db->where('id', $id);
                $this->db->update('user_sub_menu');
            } else {
                $this->db->set($dataNotActive);
                $this->db->where('id', $id);
                $this->db->update('user_sub_menu');
            }

            $this->session->set_flashdata('message', 'Submenu has been update!');
            redirect('admin/submenu');
        }
    }

    // delete submenu
    public function subdelete($id)
    {
        // model 
        $this->load->model('Bank_model', 'dlt');
        $this->dlt->deleteSub($id);

        $this->session->set_flashdata('message', 'Submenu has been deleted!');

        redirect('admin/submenu');
    }

    // edit role
    public function editrole($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // find spec role
        $roleSelect = "SELECT * FROM user_role WHERE id = $id";
        $role = $this->db->query($roleSelect)->row_array();
        $data['role'] = $role;

        // set rules
        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Role';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/editrole', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // update
            $this->db->set('role', $this->input->post('role'));
            $this->db->where('id', $id);
            $this->db->update('user_role');

            $this->session->set_flashdata('message', 'Role has been update!');
            redirect('admin/role');
        }
    }

    // delete role
    public function deleteRole($id)
    {
        // model
        $this->load->model('Bank_model', 'deleteRole');
        $this->deleteRole->deleteRole($id);

        $this->session->set_flashdata('message', 'Role has been deleted!');

        redirect('admin/role');
    }

    public function role()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role name', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Role';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer', $data);
        } else {

            // insert to database
            $data = [
                'role' => $this->input->post('role')
            ];
            $this->db->insert('user_role', $data);

            $this->session->set_flashdata('message', 'GG! New Role has been added!');
            redirect('admin/role');
        }
    }

    public function roleaccess($role_id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $data['title'] = 'Role Access';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer', $data);
    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        // pesan error
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Access Change!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
    }

    // all users
    public function users()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $count = $this->db->get('setoran')->num_rows();

        //  $config['total_rows'] = $this->db->count_all_results();
        $config['base_url'] = base_url('admin/users');
        $config['total_rows'] = $count;
        $config['per_page'] = 5;

        // initialize
        $this->pagination->initialize($config);

        // base_url('admin/submenu/(segment 3)')
        $data['start'] = $this->uri->segment(3);

        // model for users
        $this->load->model('Bank_model', 'users');
        $data['users'] = $this->users->users($config['per_page'], $data['start']);

        $data['title'] = 'Users';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/users', $data);
        $this->load->view('templates/footer', $data);
    }

    // edit users
    public function editUsers($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // id
        $data['id'] = $id;

        // model for role
        $this->load->model('Bank_model', 'users');
        $data['role'] = $this->users->role();

        // spec user
        $query = "SELECT * FROM user WHERE id = $id";
        $data['users']  = $this->db->query($query)->row_array();

        // set rules
        $this->form_validation->set_rules('name', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('address', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('telp', 'Telelpon', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Users';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/editUsers', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // model for edit user
            $this->load->model('Bank_model', 'edit');
            $data['editUsers'] = $this->edit->editUsers($id);

            $this->session->set_flashdata('message', 'user has been update!');
            redirect('admin/users');
        }
    }

    // delete user
    public function deleteUser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');

        $this->session->set_flashdata('message', 'user has been deleted!');
        redirect('admin/users');
    }

    // penjualan
    public function penjualan()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $count = $this->db->get('setoran')->num_rows();

        //  $config['total_rows'] = $this->db->count_all_results();
        $config['base_url'] = base_url('admin/penjualan');
        $config['total_rows'] = $count;
        $config['per_page'] = 5;

        // initialize
        $this->pagination->initialize($config);

        // base_url('admin/submenu/(segment 3)')
        $data['start'] = $this->uri->segment(3);

        // model
        $this->load->model('Bank_model', 'penjualan');
        $data['penjualan'] = $this->penjualan->penjualan($config['per_page'], $data['start']);

        $data['title'] = 'Penjualan Management';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/penjualan', $data);
        $this->load->view('templates/footer', $data);
    }

    // jual barang
    public function jualBarang($id)
    {
        // update data setoran
        $this->db->set('is_sold', 1);
        $this->db->where('id', $id);
        $this->db->update('setoran');

        $this->session->set_flashdata('message', 'Terjual!');

        redirect('admin/penjualan/');
    }
}
