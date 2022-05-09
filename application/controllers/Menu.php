<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Menu_model', 'menu');
    }
  
  // ### MENU ###
    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
            redirect('menu');
        }
    }
    
	  public function editMenu()
	  {
  		$this->form_validation->set_rules('id', 'id', 'required');
  		$this->form_validation->set_rules('menu', 'menu', 'required');
  		if ($this->form_validation->run() == FALSE) {
  			redirect('menu');
  		} else {
  			$data = array(
  				"menu" => $_POST['menu']
  			);
  			$this->db->where('id', $_POST['id']);
  			$this->db->update('user_menu', $data);
  		}
  		
  		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di Edit</div>');
  		redirect('menu');
	  }
	  
	  public function hapusMenu($id)
  	{
  		$this->menu->hapusMenu($id);
  		// Pesan Berhasil ketika dihapus
  		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data berhasil dihapus!</div>');
  		redirect('menu/');
  	}


// ### SUB MENU ###
    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New sub menu added!</div>');
            redirect('menu/submenu');
        }
    }
    
    public function editSubmenu()
	  {
  		$this->form_validation->set_rules('id', 'id', 'required');
  		$this->form_validation->set_rules('title', 'title', 'required');
  		$this->form_validation->set_rules('menu_id', 'menu', 'required');
  		$this->form_validation->set_rules('url', 'url', 'required');
  		$this->form_validation->set_rules('icon', 'icon', 'required');
  		if ($this->form_validation->run() == FALSE) {
  			redirect('menu/submenu');
  		} else {
  			$data = array(
  				"title" 		=> $_POST['title'],
  				"menu_id" 	=> $_POST['menu_id'],
  				"url" 		 	=> $_POST['url'],
  				"icon"			=> $_POST['icon'],
  				"is_active" => $_POST['is_active']
  			);
  			$this->db->where('id', $_POST['id']);
  			$this->db->update('user_sub_menu', $data);
  		}
  		// Pesan sukses
  		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di Edit</div>');
  		// Setelah berhasil, Pindahkan halaman ke menu management
  		redirect('menu/submenu');
	}

	// Method fungsi untuk menghapus file-file pada subMenu
	public function hapusSubMenu($id)
	{
		$this->menu->hapusSubMenu($id);

		// Pesan Berhasil ketika dihapus
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data berhasil dihapus!</div>');
		redirect('menu/submenu');
	}
}
