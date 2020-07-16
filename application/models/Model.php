<?php
class Model extends Ci_Model
{
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