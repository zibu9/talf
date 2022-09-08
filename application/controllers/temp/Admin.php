<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model');
		$this->load->model('admin_model');
	}

	public function index()
	{
		$articles = $this->compte();
		$articles['les_articles'] = $this->article_model->get_all_articles();
		$articles['politique'] = count($this->article_model->get_all_categorie_articles('Politique'));
		$articles['securite'] = count($this->article_model->get_all_categorie_articles('Securite'));
		$articles['economie'] = count($this->article_model->get_all_categorie_articles('Economie'));
		$articles['sportetsociete'] = count($this->article_model->get_all_categorie_articles('Sport')) + count($this->article_model->get_all_categorie_articles('Societe'));
		$this->load->view('admin/home', $articles);
	}

	public function login_page()
	{
		$this->load->view('admin/login');
	}

	public function login()
	{
		$login = $this->input->post('login');
		$password = $this->input->post('password');

		$result = $this->admin_model->login($login, $password);

		if ($result == null) {
			$this->load->view('admin/login', array('error'=>1));
		} else {
			$this->session->username = $login;
			$this->session->id = $result->id;
			$this->session->usertype = 'admin';
			$this->index();
		}
	}

	public function articles_by_categories()
	{
		$categorie = $this->uri->segment(3);
		$result['all_article'] = $this->article_model->get_all_categorie_articles($categorie);
		$result['categorie'] = $categorie;
		$this->load->view('admin/articles_by_categorie', $result);
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect();
	}

	public function compte()
	{
		$result['cpt_art'] = $this->article_model->count_art()->cpt_art;
		$result['cpt_arc'] = $this->article_model->count_arc()->cpt_arc;
		$result['cpt_journ'] = $this->article_model->count_journ()->cpt_journ;
		return $result;
	}

	public function edit_admin()
	{
		$result = $this->compte();
		$id = $this->session->id;
		$result['update_data'] = $this->admin_model->get_an_admin($id);
		$this->load->view('admin/edit_admin', $result);
	}

	public function submit_update_admin()
	{
		$this->form_validation->set_rules('username', 'Nom d\'utilisateur', 'required|trim|min_length[5]');
		$this->form_validation->set_rules('password', 'Mot de passe', 'required|trim|min_length[8]');

		if(($this->form_validation->run()==FALSE) ){
			$result = $this->compte();
			$result['update_data'] = $this->admin_model->get_an_admin($this->input->post('id'));
			$this->load->view('admin/edit_admin', $result);
		} else {
			extract($_POST);
			$reg_details = array(
				'username'=>$username,
				'password' =>$password
			);
			$reg_id = $this->input->post('id');
			$query_result = $this->admin_model->insert_admin_update($reg_id, $reg_details);

			if($query_result == true)
			{
				$this->session->set_flashdata('msg', 'update_true');
				$this->session->username = $username;
				redirect('admin/edit_admin', 'refresh');
			}else {
				$this->session->set_flashdata('msg', 'update_false');
				redirect('admin/edit_admin', 'refresh');
			}

		}
	}

}
