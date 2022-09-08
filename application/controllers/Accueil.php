<?php

class Accueil extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model');
		$this->load->model('accueil_model');
	}

	public function index()
	{
		$this->accueil();
	}
	public function accueil()
	{
        $result['les_articles'] = $this->article_model->get_some_articles(4, 0);
        $result['equipe'] = $this->accueil_model->get_equipe();
        $result['all'] = $this->accueil_model->get_a();
  /*      var_dump($result['all']);die();*/
        	$this->load->view('internaute/home', $result);
    }

	public function details()
	{
		$id = $this->uri->segment(3);
		$article =  $this->article_model->get_an_article($id);
		if ($article == null) {
			redirect("article/error");
		} else {
			$this->article_model->view_article_model($id);
			$result['article'] =$article;
			$result['commentaires'] = $this->article_model->get_all_article_comments($id);
			$this->load->view('internaute/details', $result);
		}

	}

	public function error()
	{
		$this->load->view('internaute/error');

	}
}
