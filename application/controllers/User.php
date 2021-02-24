<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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

        $data['title'] = 'My Profile';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function edit()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Edit Profile';

        // $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('telp', 'Telp', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $email = $this->input->post('email');
            $name = $this->input->post('name');
            $address = $this->input->post('address');
            $telp = $this->input->post('telp');

            // cek ada gambar yang akan di upload
            $uploadImage = $_FILES['image']['name'];

            // image
            if ($uploadImage) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    // cek nama gambar lama
                    $oldImage = $data['user']['image'];
                    if ($oldImage != 'default.svg') {
                        // fcpath = untuk mengetahui path ke file name (front controller)
                        // unlink = hapus
                        unlink(FCPATH . 'assets/img/profile/' . $oldImage);
                    }

                    // new image
                    $newImage = $this->upload->data('file_name');

                    $this->db->set('image', $newImage);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            // update
            $this->db->set('name', $name);
            $this->db->set('address', $address);
            $this->db->set('telp', $telp);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', 'Profile has been update!');

            redirect('user');
        }
    }

    // change password
    public function cpassword()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Change Password';

        $this->form_validation->set_rules('currentpw', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('password1', 'New Password', 'required|trim|min_length[5]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|min_length[5]|matches[password1]');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/cpassword', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $currentpw = $this->input->post('currentpw');
            $newpw = $this->input->post('password1');
            if (!password_verify($currentpw, $data['user']['password'])) {
                $this->session->set_flashdata('messageError', 'Wrong current password!');
                redirect('user/cpassword');
            } else {
                if ($currentpw == $newpw) {
                    $this->session->set_flashdata('messageError', 'New password cannot be same as current password!');
                    redirect('user/cpassword');
                } else {
                    // change password
                    $passwordHash = password_hash($newpw, PASSWORD_DEFAULT);

                    $this->db->set('password', $passwordHash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', 'Password change!');
                    redirect('user/cpassword');
                }
            }
        }
    }

    public function delete()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // delete table user
        $this->db->where('id', $data['user']['id']);
        $this->db->delete('user');

        // delete table penarikan
        $this->db->delete('penarikan', ['user_id' => $data['user']['id']]);

        // delete table setoran
        $this->db->delete('setoran', ['user_id' => $data['user']['id']]);

        // logout
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        // message
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Bye! account has been deleted!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>');

        redirect('auth');
    }

    // about
    public function about()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'About';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/about', $data);
        $this->load->view('templates/footer', $data);
    }

    // feedback
    public function feedback()
    {
        // send to email
        $this->_sendEmail();

        // pesan berhasil
        $this->session->set_flashdata('message', 'Feedback has been send!');

        redirect('user');
    }

    // send email function
    private function _sendEmail()
    {
        $email = $this->session->userdata('email');
        $text = $this->input->post('feedback');

        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'banksampahlumo@gmail.com',
            'smtp_pass' => 'siwanandarajasa1954',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('banksampahlumo@gmail.com', 'Bank Sampah Lumonata');
        $this->email->to('siwarjsa@gmail.com');

        // kirim file
        // $musik = $this->email->attach('https://www.youtube.com/watch?v=I2m2YYt4DVU');
        // $this->email->attachment_cid($musik);

        $this->email->subject('Feedback');
        $this->email->message('
            <html>
                <body>
                    <h1>Email from: ' . $email . '</h1>
                    <p>' . $text . '</p>
                </body>
            </html>
        ');

        // cek email berjalan atau tidak
        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
}
