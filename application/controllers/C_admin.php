<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_admin extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');

        date_default_timezone_set('Asia/Jakarta');

    }

    public function index()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/footer');
    }
    public function tb_produk()
    {
        $data['produk'] = $this->Model->tampil_produk();
        $this->load->view('admin/header');
        $this->load->view('admin/tb_produk',$data);
        $this->load->view('admin/footer');
    }
 
      // tambah kan fungsi upload  untuk semua
      public function upload($name)
      {
          $config['upload_path'] = './assets/images/'; //path folder
          $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
          $config['encrypt_name'] = true; //nama yang terupload nantinya
  
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
                  // redirect('c_admin/V_berita');
              }
  
          } else {
              return $response['status'] = 'image not found';
          }
      }

     public function save_produk()
     {     
         $image = $this->upload('image');
           $kategori = $this->input->post('kategori');
           if ($kategori == '0'){
               $this->session->set_flashdata('danger','kategori belum anda pilih !!');
               redirect('c_admin/tb_produk');
             }
         if ($image ['status']=='success') {
         $data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'harga_produk' => $this->input->post('harga_produk'),
                'kategori' => $this->input->post('kategori'),
                'stok_produk' => $this->input->post('stok_produk'),
                'image' => $image['data'],
                'tanggal' => date('l,d-m-Y H:i:s'),
             ];
        $this->Model->save_produk($data);
        $this->session->set_flashdata('success','Data barang di simpan');
        redirect('c_admin/tb_produk');
    }else {
        $this->session->set_flashdata('error', 'Foto yang anda upload tidak sesuai kriteria sisten !!');
        redirect('c_admin/tb_produk');
        }
    }
 
     public function delete_produk($id)
     {
         $this->Model->delete_produk($id);
         $this->session->set_flashdata('error','data berhasil di hapus');
         redirect('c_admin/tb_produk');
     }
     public function edit_produk($id)
     {
         $data['edit'] = $this->Model->edit_produk($id);
        $this->load->view('admin/header');
        $this->load->view('admin/edit_produk',$data);
        $this->load->view('admin/footer');
     }
     public function update($id)
     {
         $image = $this->upload('image');
         if ($image['status'] == 'success') {
            $data =[
                'nama_produk' =>$this->input->post('nama_produk'),
                'harga_produk' =>$this->input->post('harga_produk'),
                'kategori' =>$this->input->post('kategori'),
                'stok_produk' =>$this->input->post('stok_produk'),
                'image' =>$image['data'],
                ];
            }else {
                $data =[
                    'nama_produk' =>$this->input->post('nama_produk'),
                    'harga_produk' =>$this->input->post('harga_produk'),
                    'kategori' =>$this->input->post('kategori'),
                    'stok_produk' =>$this->input->post('stok_produk'),

                    ];
            }
            $this->Model->update($id,$data);
            // print_r($data);
         
         $this->session->set_flashdata('success','Data berhasil di ubah');
         redirect('c_admin/tb_produk');
     }
 
}


?>