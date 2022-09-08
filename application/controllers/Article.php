<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller
{
    const NB_ARTICLE_PAR_PAGE = 8;
	public $toutes_categories;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model');
	}

	public function index($g_nb_art = 1)
	{
		$this->accueil($g_nb_art);
	}
	public function accueil($g_nb_art = 1)
	{

		$this->load->library('pagination');

		$articles = array();
		$all_articles = $this->article_model->to_count();
		        //  On vérifie la cohérence de la variable $_GET
        if($g_nb_art > 1)
        {
            if($g_nb_art <= $all_articles)
            {

                $nb_art = intval($g_nb_art);
            }
            else
            {
                //  Il n'y pas assez de messages dans la base de données.

                $nb_art = 1;
            }
        }
        else
        {

            $nb_art = 1;
        }
        //  Mise en place de la pagination
        $this->pagination->initialize(array('base_url' => base_url() . 'index.php/article/accueil',
                            'total_rows' => $all_articles,
                            'per_page' => self::NB_ARTICLE_PAR_PAGE)); 

        $articles['pagination'] = $this->pagination->create_links();
        $articles['nb_art'] = $all_articles;

        //  Maintenant que l'on connaît le numéro du commentaire, on peut lancer
        //  la requête récupérant les commentaires dans la base de données.
        $articles['les_articles'] = $this->article_model->get_some_articles(self::NB_ARTICLE_PAR_PAGE, $nb_art-1);

        //  On charge la vue
        	$this->load->view('internaute/blog', $articles);
    }

	public function like_article()
	{
		$id = $this->uri->segment(3);
		$result = $this->article_model->like_article_model($id);
		
		if ($result == true) {
			$article =  $this->article_model->get_an_article($id);
			redirect('article/details/'.$id.'/'.$article->id_categorie.'/'.$article->annee.'/'.time().rand(1, 2020), 'refresh');
		} else {
			redirect('article/details/'.$id, 'refresh');
		}
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
