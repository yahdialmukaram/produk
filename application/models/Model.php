<?php
class Model extends Ci_Model
{
   public function tampil_produk()
   {
       return $this->db->get('tb_produk')->result_array();
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
   public function check_account($username,$password)
    {
        $this->db->from('tb_user');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        return $this->db->get();
    }
}


?>