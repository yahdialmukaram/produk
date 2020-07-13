<?php
class Model extends Ci_Model
{
   public function tampil_barang()
   {
       return $this->db->get('tb_barang')->result_array();
   }
   public function save_barang($data)
   {
       $this->db->insert('tb_barang',$data);
   }
   public function delete_barang($id)
   {
    $this->db->where('id_barang',$id); 
       $this->db->delete('tb_barang');
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