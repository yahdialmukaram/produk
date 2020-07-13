<?php

class C_login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_login');

    }

    public function index()
    {
        $this->load->view('admin/login');

    }

 

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('C_login');

    }
    // make account
    public function make_account(Type $var = null)
    {
        // buat array data yang akan di input
        $username = 'admin';
        $data = [
            'username' => $username,
            'password' => hash('md5', 'admin'),
            'level' => 'admin',
            'create_at' => date('d-m-Y H:i:s'),
        ];
        // check data sudah ada atau belum di database, biar data user nggak dempet
        // ambil data dari database berdasarkan username
        $check_username = $this->Model->find('tb_user', 'username', $username);
        // beri perintah if
        if ($check_username->num_rows() > 0) {
            $response = ['status' => 'username sudah terdaftar'];
        } else {
            $this->Model->create('tb_user', $data);
            $response = ['status' => ' username berhasil di tambahkan'];
        }
        echo json_encode($response);
    }
    // verifikasi akun user
    public function verification(Type $var = null)
    {
        // ambil username dan password
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        // sekarang check ke database ada tidak data dari username
        $check_username = $this->Model->check_account($username,hash('md5',$password));
        // jika tidak ada kembalikan ke login dan beri aler
        if ($check_username->num_rows() == '0') {   //jika username di hitung sama dengan 0
            // beri alert dengan flash
            $this->session->set_flashdata('error', 'Maaf username yang anda masukan salah');
            redirect('c_login');
        }
        // jika ada buat sesi login
        else {
            $result = $check_username->row_array(); //ambil satu data dari database
            // buat array untuk session
            $ses_data = [
                'username' => $result['username'],
                'level' => $result['level'],
				'id_user' => $result['id_user'],
				'logged_in'=>true,
            ];
            // buat sssionnya
            $this->session->set_userdata($ses_data);
			// arahkan sesuai level user
			if ($this->session->userdata('level')=='admin'
			) {
				redirect('c_admin');
			}
        }
    }
}
