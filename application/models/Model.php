<?php
class Model extends Ci_Model{

    public function check_account($username,$password)
    {
        $this->db->from('tb_user');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        return $this->db->get();
    }
   public function tampil_produk()
   {
       $this->db->from('tb_produk');
       $this->db->order_by('id_produk','desc');
       return $this->db->get()->result_array();
   }

//    kode otomatis
   public function kode_otomatis()
   {
    $this->db->select('RIGHT(tb_produk.kode_produk,2) as kode_produk', FALSE);
    $this->db->order_by('kode_produk','DESC');    
    $this->db->limit(1);    
    $query = $this->db->get('tb_produk');  //cek dulu apakah ada sudah ada kode di tabel.    
    if($query->num_rows() > 0){      
         //cek kode jika telah tersedia    
         $data = $query->row();      
         $kode = intval($data->kode_produk) + 1; 
    }
    else{      
         $kode = 1;  //cek jika kode belum terdapat pada table
    }
        $tgl=date('dmY'); 
        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
        $kodetampil = "KD"."5".$tgl.$batas;  //format kode
        return $kodetampil;  
   }


   public function save_produk($data)
   {
       $this->db->insert('tb_produk',$data);
   }
   public function delete_produk($id)
   {
    $this->db->where('id_produk',$id); 
       $this->db->delete('tb_produk');
   }
   public function edit_produk($id)
   {
   $this->db->where('id_produk',$id);
   return $this->db->get('tb_produk')->row_array();//menampilkan satu data
   }
   public function update($id,$data)
   {
       $this->db->where('id_produk',$id);
       $this->db->update('tb_produk',$data);
   }
}


?>