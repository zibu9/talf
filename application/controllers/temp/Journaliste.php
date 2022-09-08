<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journaliste extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('journaliste_model');
		$this->load->model('article_model');
		
	}

	public function login_page()
	{
		$this->load->view('journaliste/login');
	}

	public function login()
	{
		$login = $this->input->post('login');
		$password = $this->input->post('password');

		$result = $this->journaliste_model->login($login, $password);

		if ($result == null) {
			$this->load->view('journaliste/login', array('error'=>1));
		} else {
			$this->session->username = $login;
			$this->session->id = $result->id;
			$this->session->usertype = 'journaliste';
			redirect('journaliste/accueil','refresh');
		}
	}

	public function index()
	{
		if (isset($this->session->id)) {
			$this->accueil();
		} else {
			$this->login_page();
		}
	}

	public function accueil()
	{
		$articles['les_articles'] = $this->journaliste_model->get_all_journaliste_articles($this->session->id);
		$this->load->view('journaliste/home', $articles);
	}

	public function new_journaliste_page()
	{
		$result = $this->compte();
		$this->load->view('admin/new_journaliste', $result);
	}

	public function submit_new_journaliste()
	{
		$this->form_validation->set_rules('username', 'Nom d\'utilisateur', 'required|trim|is_unique[journalistes.username]|min_length[5]');
		$this->form_validation->set_rules('password', 'Mot de passe', 'required|trim|min_length[8]');

		if(($this->form_validation->run()==FALSE) ){
			$result = $this->compte();
			$this->load->view('new_journaliste', $result);
		}else {
			extract($_POST);
			$reg_details = array(
				'id'=>null,
				'username'=>$username,
				'password' =>$password
			);

			$query_result = $this->journaliste_model->insert_journaliste($reg_details);

			if($query_result == true)
			{
				$this->session->set_flashdata('msg', 'insert_true');
				redirect('journaliste/all_journaliste_page', 'refresh');
			}else {
				$this->session->set_flashdata('msg', 'insert_false');
				redirect('journaliste/new_journaliste_page', 'refresh');
			}

		}
	}

	public function all_journaliste_page()
	{
		$journalistes = $this->compte();
		$journalistes['all_journaliste'] = $this->journaliste_model->get_all_journalistes();
		$this->load->view('admin/all_journalistes', $journalistes);
	}

	public function edit_journaliste()
	{
		$result = $this->compte();
		$id = $this->uri->segment(3);
		$result['update_data'] = $this->journaliste_model->get_a_journaliste($id);
		$this->load->view('admin/edit_journaliste', $result);
	}

	public function delete_journaliste()
	{
		$id = $this->uri->segment(3);
		$result = $this->journaliste_model->delete_journaliste($id);
		if ($result == true) {
			$this->session->set_flashdata('msg', 'delete_true');
			redirect('journaliste/all_journaliste_page', 'refresh');
		} else {
			$this->session->set_flashdata('msg', 'delete_false');
			redirect('journaliste/all_journaliste_page', 'refresh');
		}
	}

	public function submit_update_journaliste()
	{
		$this->form_validation->set_rules('username', 'Nom d\'utilisateur', 'required|trim|min_length[5]');
		$this->form_validation->set_rules('password', 'Mot de passe', 'required|trim|min_length[8]');

		if(($this->form_validation->run()==FALSE) ){
			$result = $this->compte();
			$result['update_data'] = $this->journaliste_model->get_a_journaliste($this->input->post('id'));
			$this->load->view('admin/edit_journaliste', $result);
		} else {
			extract($_POST);
			$reg_details = array(
				'username'=>$username,
				'password' =>$password
			);
			$reg_id = $this->input->post('id');
			$query_result = $this->journaliste_model->insert_journaliste_update($reg_id, $reg_details);

			if($query_result == true)
			{
				$this->session->set_flashdata('msg', 'update_true');
				redirect('journaliste/all_journaliste_page', 'refresh');
			}else {
				$this->session->set_flashdata('msg', 'update_false');
				redirect('journaliste/all_journaliste_pagee', 'refresh');
			}

		}
	}

	public function new_article_page()
	{
		$this->load->view('journaliste/new_article');
	} 

	public function all_article_page()
	{
		$articles['les_articles'] = $this->journaliste_model->get_all_journaliste_articles($this->session->id);
		$this->load->view('journaliste/my_articles', $articles);
	}

	public function delete_article()
	{
		$id = $this->uri->segment(3);
		$result = $this->article_model->delete_artile_model($id);
		if ($result == true) {
			$this->session->set_flashdata('msg', 'delete_true');
			redirect('journaliste/all_article_page', 'refresh');
		} else {
			$this->session->set_flashdata('msg', 'delete_false');
			redirect('journaliste/all_article_page', 'refresh');
		}
	}

	public function archive_article()
	{
		$id = $this->uri->segment(3);
		$result = $this->article_model->archive_article_model($id);
		if ($result == true) {
			$this->session->set_flashdata('msg', 'archive_true');
			redirect('journaliste/all_article_page', 'refresh');
		} else {
			$this->session->set_flashdata('msg', 'archive_false');
			redirect('journaliste/all_article_page', 'refresh');
		}
	}


	public function submit_new_article()
	{
		$this->form_validation->set_rules('titre', 'Titre', 'required|trim|is_unique[articles.titre]|min_length[5]');
		$this->form_validation->set_rules('categorie', 'Catégorie', 'required');
		$this->form_validation->set_rules('details', 'Contenu', 'required|trim|min_length[5]');
		$config['upload_path'] = './pictures/';
		$config['allowed_types'] = 'gif|jpeg|png|jpg|pdf';
		$config['file_name'] = time().rand(1, 2020);
		$config['max_size'] = 10000000;
		$config['max_width'] = 10240;
		$config['max_height'] = 10240;
		$config['overwrite'] = false;
		$this->load->library('upload', $config);

		if(($this->form_validation->run()==FALSE) ){
			$this->load->view('journaliste/new_article');
		}elseif (!$this->upload->do_upload('image')) {
			$error = array('error'=>$this->upload->display_errors());
			$this->load->view('journaliste/new_article', $error);
		} else {
			extract($_POST);
			$data = $this->upload->data();
			$file_name = $data['file_name'];

			$reg_details = array(
				'id'=>null,
				'titre'=>$titre,
				'id_categorie' =>$categorie,
				'img_path' =>base_url().'pictures/'.$file_name,
				'img_comment' =>$commentaire,
				'contenu' =>$details,
				'date_pub' =>date('Y-m-d H:i:s', time()),
				'date_mod' =>date('Y-m-d H:i:s', time()),
				'archive' =>"non",
				'id_journaliste'=>$this->session->id,
				'nb_vues' =>0
			);
			
			$query_result = $this->article_model->insert_article($reg_details);
			$id_art = $this->article_model->get_article_by_titre($titre);
			if(isset($_FILES['pdf'])){
				if($this->upload->do_upload('pdf')){
						
						$data3 = $this->upload->data();
						$file_name3 = $data3['file_name'];
						$reg_detail = array(
						'id'=>null,
						'id_art'=>$id_art,
						'pdf_path' =>base_url().'pictures/'.$file_name3,
						'extrait'=>$_POST[$extrait]

					);
						$this->article_model->insert_pdf($reg_detail);
				}
			}
			if (count($_FILES) > 1) {
				for ($i=1; $i < count($_FILES); $i++) {
					$key = $i + 1;
					$det = "details".$key;
					$key = 'image'.$key;
					$extrait = 'extrait';
					
					if($this->upload->do_upload($key)){
						
						$data2 = $this->upload->data();
						$file_name2 = $data2['file_name'];
						$reg_detail = array(
						'id'=>null,
						'id_art'=>$id_art,
						'img_path' =>base_url().'pictures/'.$file_name2,
						'details'=>$_POST[$det]

					);
						$this->article_model->insert_image($reg_detail);
						
					}
				}
			}
			if($query_result == true)
			{
				$this->session->set_flashdata('msg', 'insert_true');
				redirect('journaliste/all_article_page', 'refresh');
			}else {
				$this->session->set_flashdata('msg', 'insert_false');
				redirect('journaliste/new_article_page', 'refresh');
			}

		}
	}

	public function edit_article()
	{
		$id = $this->uri->segment(3);
		$result['update_data'] = $this->article_model->get_an_article($id);
		$this->load->view('journaliste/edit_article', $result);
	}

	public function submit_update_article()
	{
		$this->form_validation->set_rules('titre', 'Titre', 'required|trim|min_length[5]');
		$this->form_validation->set_rules('categorie', 'Catégorie', 'required');
		$this->form_validation->set_rules('details', 'Contenu', 'required|trim|min_length[5]');
		$config['upload_path'] = './pictures/';
		$config['allowed_types'] = 'gif|jpeg|png';
		$config['max_size'] = 1024;
		$config['max_width'] = 1024;
		$config['max_height'] = 768;
		$config['overwrite'] = false;

		$this->load->library('upload', $config);

		if(($this->form_validation->run()==FALSE) ){
			$result['update_data'] = $this->article_model->get_an_article($this->input->post('id'));
			$this->load->view('journaliste/edit_article', $result);
		} else {
			$reg_id = $this->input->post('id');
			$un_art = $this->article_model->get_an_article($reg_id);

			if (!$this->upload->do_upload('image')) {
				$file_name = $un_art->img_path;
			}else {
				$data = $this->upload->data();
				$file_name = base_url().'pictures/'.$data['file_name'];
			}
			extract($_POST);

			$reg_details = array(
				'titre'=>$titre,
				'id_categorie' =>$categorie,
				'img_path' =>'pictures/'.$file_name,
				'img_comment' =>$commentaire,
				'contenu' =>$details,
				'date_mod' =>date('Y-m-d H:i:s', time())
			);
			$reg_id = $this->input->post('id');
			$query_result = $this->article_model->insert_article_update($reg_id, $reg_details);

			if($query_result == true)
			{
				$this->session->set_flashdata('msg', 'update_true');
				redirect('journaliste/all_article_page', 'refresh');
			}else {
				$this->session->set_flashdata('msg', 'update_false');
				redirect('journaliste/all_article_page', 'refresh');
			}

		}
	}

	public function compte()
	{
		$result['cpt_art'] = $this->article_model->count_art()->cpt_art;
		$result['cpt_arc'] = $this->article_model->count_arc()->cpt_arc;
		$result['cpt_journ'] = $this->article_model->count_journ()->cpt_journ;
		return $result;
	}

	public function edit_journaliste_him_self()
	{
		$id = $this->session->id;
		$result['update_data'] = $this->journaliste_model->get_a_journaliste($id);
		$this->load->view('journaliste/edit_journaliste', $result);
	}

	public function submit_update_journaliste_him_self()
	{
		$this->form_validation->set_rules('password', 'Mot de passe', 'required|trim|min_length[8]');

		if(($this->form_validation->run()==FALSE) ){
			$result = $this->compte();
			$result['update_data'] = $this->journaliste_model->get_a_journaliste($this->input->post('id'));
			$this->load->view('journaliste/edit_journaliste', $result);
		} else {
			extract($_POST);
			$reg_details = array(
				'password' =>$password
			);
			$reg_id = $this->input->post('id');
			$query_result = $this->journaliste_model->insert_journaliste_update($reg_id, $reg_details);

			if($query_result == true)
			{
				$this->session->set_flashdata('msg', 'update_true');
				redirect('journaliste/edit_journaliste_him_self', 'refresh');
			}else {
				$this->session->set_flashdata('msg', 'update_false');
				redirect('journaliste/edit_journaliste_him_self', 'refresh');
			}

		}
	}

}
