<?php

class Journaliste extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('journaliste_model');
		$this->load->model('article_model');
		$this->load->model('accueil_model');
		$this->load->library('session');
		$article['equipe'] = $this->accueil_model->get_equipe();
		$this->load->view('journaliste/leftpanel', $article);
		
	}

	public function index()
	{
		if (isset($this->session->id)) {
			$this->accueil();
		} 
		else 
		{
			$this->login_page();
		}	
	}

	public function logout(){
		if (isset($this->session->id)) {
			$this->session->sess_destroy();
			redirect('accueil');
		} 
		else 
		{
			$this->login_page();
		}	
		
	}

	public function login_page()
	{
		$this->load->view('journaliste/login');
	}

	public function login()
	{
		$login = $this->input->post('login');
		$password = $this->input->post('password');
		$result = $this->journaliste_model->login($login);
		if ((password_verify($password, $result->password))) {
			$this->session->username = $login;
			$this->session->id = $result->id;
			$this->session->usertype = 'journaliste';
			redirect('journaliste/accueil','refresh');			
		}
		else{
			$this->load->view('journaliste/login', array('error'=>1));
		}

	}

	public function accueil()
	{
		if (isset($this->session->id)) {
			$articles['les_articles'] = $this->journaliste_model->get_all_journaliste_articles();
			$this->load->view('journaliste/home', $articles);
		} 
		else 
		{
			$this->login_page();
		}	
		
	}

	public function submit_new_article()
	{
		if (isset($this->session->id)) {
			$this->form_validation->set_rules('titre', 'Titre', 'required|trim|is_unique[articles.titre]|min_length[5]');
			$this->form_validation->set_rules('details', 'Contenu', 'required|trim|min_length[5]');
			$config['upload_path'] = './pictures/';
			$config['allowed_types'] = 'gif|jpeg|png|jpg';
			$config['file_name'] = time().rand(1, 2020);
			$config['max_size'] = 10000; 
			$config['overwrite'] = true;
			$config['max_width'] = 10240;
			$config['max_height'] = 10240;
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
				$config['image_library'] = 'gd2';
				$config['source_image'] = './pictures/'.$file_name;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['quality'] = '100%';
				$config['width'] = 640;
				$config['height'] = 320;
				$config['new_image'] = './pictures/'.'IMG-'.$file_name;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$reg_details = array(
					'id'=>null,
					'titre'=>$titre,
					'img_path' => 'IMG-'.$file_name,
					'contenu' =>$details,
					'date_pub' =>date('Y-m-d H:i:s', time()),
					'nb_vues' =>0,
					'nb_vues' =>0
				);
				unlink('./pictures/'.$file_name);
				/*var_dump($reg_details);die();*/
				$query_result = $this->article_model->insert_article($reg_details);
				$id_art = $this->article_model->get_article_by_titre($titre);

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
		else 
		{
			$this->login_page();
		}	

	}

	public function new_article_page()
	{
		if (isset($this->session->id)) {
			$this->load->view('journaliste/new_article');	
		} 
		else 
		{
			$this->login_page();
		}	
		
	}

	public function apropos()
	{
		if (isset($this->session->id)) {
			$result['key'] = "apropos";
			$result['update'] = $this->accueil_model->get_all();
			$this->load->view('journaliste/edit_propos',$result);			
		} 
		else 
		{
			$this->login_page();
		}	

	} 

	public function objectifs()
	{
		if (isset($this->session->id)) {
			$result['key'] = "objectifs";
			$result['update'] = $this->accueil_model->get_all();
			$this->load->view('journaliste/edit_propos',$result);			
		} 
		else 
		{
			$this->login_page();
		}	

	} 



	public function all_article_page()
	{
		if (isset($this->session->id)) {
			$articles['les_articles'] = $this->journaliste_model->get_all_journaliste_articles($this->session->id);
			$this->load->view('journaliste/my_articles', $articles);			
		} 
		else 
		{
			$this->login_page();
		}	

	}

	public function submit_apropos(){

		if (isset($this->session->id)) {
			$this->form_validation->set_rules('details', 'Contenu', 'required|trim|min_length[5]');
			if (($this->form_validation->run()==FALSE) ) {
				redirect('journaliste/', 'refresh');
			} else {
				$details = $this->input->post('details');
				$donnees = array(
					'apropos' =>$details,
				);
				$query_result = $this->accueil_model->u_propos($donnees);

				if($query_result == true)
				{
					$this->session->set_flashdata('msg', 'update_true');
					redirect('journaliste/all_article_page', 'refresh');
				}else {
					$this->session->set_flashdata('msg', 'update_false');
					redirect('journaliste/', 'refresh');
				}					
			}
		} 
		else 
		{
			$this->login_page();
		}	
	}

	public function submit_objectifs(){
			if (isset($this->session->id)) {

			$this->form_validation->set_rules('details', 'Contenu', 'required|trim|min_length[5]');
			if (($this->form_validation->run()==FALSE) ) {
				redirect('journaliste/', 'refresh');
			} else {
				$details = $this->input->post('details');
				$donnees = array(
					'objectifs' =>$details,
				);
				$query_result = $this->accueil_model->u_propos($donnees);

				if($query_result == true)
				{
					$this->session->set_flashdata('msg', 'update_true');
					redirect('journaliste/all_article_page', 'refresh');
				}else {
					$this->session->set_flashdata('msg', 'update_false');
					redirect('journaliste/', 'refresh');
				}	
			}
		} 
		else 
		{
			$this->login_page();
		}	
	}

	public function edit_journaliste_him_self()
	{
		if (isset($this->session->id)) {
			$id = $this->session->id;
			$result['update_data'] = $this->journaliste_model->get_a_journaliste($id);
			$this->load->view('journaliste/edit_journaliste', $result);						
		} 
		else 
		{
			$this->login_page();
		}	

	}

	public function submit_update_journaliste_him_self()
	{
		if (isset($this->session->id)) {
			$this->form_validation->set_rules('password', 'Mot de passe', 'required|trim|min_length[6]');

			if(($this->form_validation->run()==FALSE) ){
				$result['update_data'] = $this->journaliste_model->get_a_journaliste($this->input->post('id'));
				$this->load->view('journaliste/edit_journaliste', $result);
			} else {
				extract($_POST);
				$mdp = password_hash($password, PASSWORD_DEFAULT);
				$details = array(
					'password' =>$mdp
				);
				$id = $this->input->post('id');
				$query_result = $this->journaliste_model->insert_journaliste_update($id, $details);

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
		else 
		{
			$this->login_page();
		}	

	}

	public function equipe($id){

		if (isset($this->session->id)) {
			
			$result['equipe'] = $this->accueil_model->get_eq($id);
			$this->load->view('journaliste/equipe',$result);			
		} 
		else 
		{
			$this->login_page();
		}	
	}

	public function submit_equipe(){

		if (isset($this->session->id)) {

	      $this->form_validation->set_rules('prenom', 'Prenom', 'required|trim|min_length[3]');
	      $this->form_validation->set_rules('nom', 'Nom', 'required|trim|min_length[3]');
	      $this->form_validation->set_rules('grade', 'Grade');
	      $config['upload_path'] = './pictures/';
	      $config['allowed_types'] = 'gif|jpeg|png|jpg';
	      $config['file_name'] = time().rand(1, 2020);
	      $config['max_size'] = 10000; 
	      $config['overwrite'] = true;
	      $config['max_width'] = 10240;
	      $config['max_height'] = 10240; 

	      $this->load->library('upload', $config);
			if (!$this->upload->do_upload('image')) {
	        	$file_name = 'autho.png';
	        }else{

	        	$data = $this->upload->data();
	          	$file_name = $data['file_name']; 
	        }
		      extract($_POST);
	          $data = $this->upload->data();    
	          $config['image_library'] = 'gd2';
	          $config['source_image'] = './pictures/'.$file_name;
	          $config['create_thumb'] = FALSE;
	          $config['maintain_ratio'] = FALSE;
	          $config['quality'] = '100%';
	          $config['width'] = 225;
	          $config['height'] = 225;
	          $config['new_image'] = './pictures/'."AUTH-".$file_name;
	          $this->load->library('image_lib', $config);
	          $this->image_lib->resize();

	          $reg_details = array(
	            'prenom'=>$prenom,
	            'nom'=>$nom,
	            'grade' =>$grade,
	            'photo' => 'AUTH-'.$file_name
	            
	          );
	          unlink('./pictures/'.$file_name);
/*var_dump($reg_details);die();*/
	          	$query_result = $this->journaliste_model->equipe_update($id,$reg_details);

				if($query_result == true)
				{
					$this->session->set_flashdata('msg', 'update_true');
					redirect('journaliste/all_article_page', 'refresh');
				}else {
					$this->session->set_flashdata('msg', 'update_false');
					redirect('journaliste/new_article_page', 'refresh');
				}

		} else {
			$this->login_page();
			
		}
		
	}
}