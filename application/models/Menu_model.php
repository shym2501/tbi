<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
  // Read Menu and Sub Menu
  public function getSubMenu()
  {
    $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
      FROM `user_sub_menu` JOIN `user_menu`
      ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
      ";
    return $this->db->query($query)->result_array();
  }
  
  // Delete Menu
  public function hapusMenu($id)
  {
		$this->db->where('id', $id);
		$this->db->delete('user_menu');
	 }
	 
	 // Delete Sub Menu
	 public function hapusSubMenu($id)
	 {
	   $this->db->where('id', $id);
	   $this->db->delete('user_sub_menu');
	 }
}
