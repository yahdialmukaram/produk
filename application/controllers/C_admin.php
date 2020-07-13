<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_admin extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');

    }

    public function index()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/footer');
    }
    public function tb_barang()
    {
        $data['barang'] = $this->Model->tampil_barang();
        $this->load->view('admin/header');
        $this->load->view('admin/tb_barang',$data);
        $this->load->view('admin/footer');
    }
     // tambah kan fungsi upload  untuk semua
     public function upload($name)
     {
         $config['upload_path'] = './assets/images/'; //path folder
         $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
         $config['encrypt_name'] = true; //nama yang terupload nantinya
        //  $this->load->library('upload', $config);
        $this->upload->initialize($config);
         if (!empty($_FILES[$name]['name'])) {
             if ($this->upload->do_upload($name)) {
                 $gbr = $this->upload->data();
                 // Compress Image
                 $config['image_library'] = 'gd2';
                 $config['source_image'] = './assets/images/' . $gbr['file_name'];
                 $config['create_thumb'] = false;
                 $config['maintain_ratio'] = false;
                 $config['quality'] = '60%';
                 $config['width'] = 710;
                 $config['height'] = 420;
                 $config['new_image'] = './assets/images/' . $gbr['file_name'];
                 $this->load->library('image_lib', $config);
                 $this->image_lib->resize();
                 $response['data'] = $gbr['file_name'];
                 $response['status'] = 'success';
                 return $response;
             } else {
                 $response['status'] = 'error';
                 return $response;
                //  redirect('c_admin/tb_barang');
             }
 
         } else {
             return $response['status'] = 'image not found';
         }
     }
     public function save_barang()
     {     
           $kategori = $this->input->post('kategori');
           if ($kategori == '0'){
               $this->session->set_flashdata('danger','kategori belum anda pilih !!');
               redirect('c_admin/tb_barang');
             }
         $image = $this->upload('image');
         if ($image ['status']=='success') {
         $data = [
                'nama_barang' => $this->input->post('nama_barang'),
                'harga_barang' => $this->input->post('harga_barang'),
                'kategori' => $this->input->post('kategori'),
                'stok_barang' => $this->input->post('stok_barang'),
                'image' => $image['data'],
                'tanggal' => date('d-m-Y'), 
             ];
        $this->Model->save_barang($data);
        $this->session->set_flashdata('success','Data barang di simpan');
        redirect('c_admin/tb_barang');
    }else {
        $this->session->set_flashdata('danger', 'Foto yang anda upload tidak sesuai kriteria sisten !!');
        redirect('c_admin/tb_barang');
        }
    }
 
     public function delete_barang($id)
     {
         $this->Model->delete_barang($id);
         $this->session->set_flashdata('danger','data berhasil di hapus');
         redirect('c_admin/tb_barang');
     }
 
}


?>