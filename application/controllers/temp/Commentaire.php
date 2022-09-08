<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commentaire extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('commentaire_model');
		$this->load->model('article_model');
	}

	public function index()
	{
		echo '';
	}

	public function submit_new_comment()
	{
		extract($_POST);
		$username = ($username=='') ? '...' : $username ;
		$pseudo = ($pseudo=='') ? '...' : $pseudo ;
		$reg_details = array(
			'id'=>null,
			'username'=>$username,
			'pseudo' =>$pseudo,
			'commentaire' =>$commentaire,
			'date_pub' =>date("Y-m-d H:i:s",time()),
			'id_article' =>$id
		);

		$query_result = $this->commentaire_model->insert_article($reg_details);

		if($query_result == true)
		{
			$this->session->set_flashdata('msg', 'insert_true');
			redirect('commentaire/all_article_comments/'.$id, 'refresh');
		}else {
			$this->session->set_flashdata('msg', 'insert_false');
			redirect('commentaire/all_article_comments/'.$id, 'refresh');
			}
	}

	public function all_article_comments()
	{
		$id = $this->uri->segment(3);
		$result['commentaires'] = $this->commentaire_model->get_all_article_comments($id);
		$result['article'] = $this->commentaire_model->get_an_article($id);
		$this->load->view('internaute/all_comments', $result);
	}

	public function all_article_comments_admin()
	{
		$result = $this->compte();
		$id = $this->uri->segment(3);
		$result['commentaires'] = $this->commentaire_model->get_all_article_comments($id);
		$result['article'] = $this->commentaire_model->get_an_article($id);
		$this->load->view('admin/all_comments', $result);
	}

	public function compte()
	{
		$result['cpt_art'] = $this->article_model->count_art()->cpt_art;
		$result['cpt_arc'] = $this->article_model->count_arc()->cpt_arc;
		$result['cpt_journ'] = $this->article_model->count_journ()->cpt_journ;
		return $result;
	}

	public function delete_commentaire()
	{
		$id = $this->uri->segment(3);
		$com = $this->commentaire_model->get_a_comment($id);
		$result = $this->commentaire_model->delete_commentaire_model($id);
		if ($result == true) {
			$this->session->set_flashdata('msg', 'delete_true');
			redirect('commentaire/all_article_comments_admin/'.$com->id_article, 'refresh');
		} else {
			$this->session->set_flashdata('msg', 'delete_false');
			redirect('commentaire/all_article_comments_admin/'.$com->$id_article, 'refresh');
		}
	}
}
