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
}


?>