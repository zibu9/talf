<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller
{
    const NB_ARTICLE_PAR_PAGE = 12;
	public $toutes_categories;

	public function __construct()
	{
		parent::__construct();
		$this->toutes_categories = ["Politique", "Securite", "Economie", "Sport", "Justice", "Sante", "Culture", "Societe", "Diplomatie", "Education", "Autres"];
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
        	$this->load->view('internaute/home', $articles);
    }

	public function new_article_page()
	{
		$result = $this->compte();
		$this->load->view('admin/new_article', $result);
	}

	public function submit_new_article()
	{
		$this->form_validation->set_rules('titre', 'Titre', 'required|trim|is_unique[articles.titre]|min_length[5]');
		$this->form_validation->set_rules('categorie', 'Catégorie', 'required');
		$this->form_validation->set_rules('details', 'Contenu', 'required|trim|min_length[5]');
		$config['upload_path'] = './pictures/';
		$config['allowed_types'] = 'gif|jpeg|png|jpg';
		$config['file_name'] = time().rand(1, 2020);
		$config['max_size'] = 10000000;
		$config['max_width'] = 10240;
		$config['max_height'] = 10240;
		$config['overwrite'] = false;

		$this->load->library('upload', $config);

		if(($this->form_validation->run()==FALSE) ){
			$result = $this->compte();
			$this->load->view('admin/new_article', $result);
		}elseif (!$this->upload->do_upload('image')) {
			$error = $this->compte();
			$error['error']= $this->upload->display_errors();
			$this->load->view('admin/new_article', $error);
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
				'nb_vues' =>0
			);

			$query_result = $this->article_model->insert_article($reg_details);
			$id_art = $this->article_model->get_article_by_titre($titre)->id;
			if(isset($_FILES['pdf2'])){
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
					echo $key;
					if($this->upload->do_upload($key)){
						$data2 = $this->upload->data();
						$file_name2 = $data2['file_name'];
						$reg_detail = array('id'=>null, 'id_art'=>$id_art,'img_path' =>base_url().'pictures/'.$file_name2, "details"=>$_POST[$det]); 
						$this->article_model->insert_image($reg_detail);
					}
				}
			}
			if($query_result == true)
			{
				$this->session->set_flashdata('msg', 'insert_true');
				redirect('article/all_article_page', 'refresh');
			}else {
				$this->session->set_flashdata('msg', 'insert_false');
				redirect('admin/new_article_page', 'refresh');
			}

		}
	}

	public function all_articles_user()
	{
		$articles['les_articles'] = $this->article_model->get_all_articles_user();
		$this->load->view('internaute/all_articles', $articles);
	}
	public function all_article_page()
	{
		$articles = $result = $this->compte();
		$articles['all_article'] = $this->article_model->get_all_articles();
		$this->load->view('admin/all_articles', $articles);
	}

	public function archive_articles_page()
	{
		$articles = $result = $this->compte();
		$articles['all_article'] = $this->article_model->get_all_archives();
		$this->load->view('admin/all_archives', $articles);
	}

	public function edit_article()
	{
		$id = $this->uri->segment(3);
		$result = $result = $this->compte();
		$result['update_data'] = $this->article_model->get_an_article($id);
		$this->load->view('admin/edit_article', $result);
	}

	public function delete_article()
	{
		$id = $this->uri->segment(3);
		$result = $this->article_model->delete_artile_model($id);
		if ($result == true) {
			$this->session->set_flashdata('msg', 'delete_true');
			redirect('article/all_article_page', 'refresh');
		} else {
			$this->session->set_flashdata('msg', 'delete_false');
			redirect('article/all_article_page', 'refresh');
		}
	}

	public function archive_article()
	{
		$id = $this->uri->segment(3);
		$result = $this->article_model->archive_article_model($id);
		if ($result == true) {
			$this->session->set_flashdata('msg', 'archive_true');
			redirect('article/all_article_page', 'refresh');
		} else {
			$this->session->set_flashdata('msg', 'archive_false');
			redirect('article/all_article_page', 'refresh');
		}
	}

	public function unarchive_article()
	{
		$id = $this->uri->segment(3);
		$result = $this->article_model->unarchive_article_model($id);
		if ($result == true) {
			$this->session->set_flashdata('msg', 'unarchive_true');
			redirect('article/all_article_page', 'refresh');
		} else {
			$this->session->set_flashdata('msg', 'unarchive_false');
			redirect('article/archive_articles_page', 'refresh');
		}
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
			$result['same_categorie'] = $this->article_model->get_all_categorie_articles_top10($article->id_categorie);
			$result['top10'] = $this->article_model->get_articles_by_views();
			$result['article'] =$article;
			$result['commentaires'] = $this->article_model->get_all_article_comments($id);
			$result['archives'] = $this->article_model->count_archive_by_year();
			$result['categorie'] = $article->id_categorie;
			$result['images'] = $this->article_model->get_all_article_images($id);
			$result['pdf'] = $this->article_model->get_all_article_pdf($id);
	        $result['les_article'] = $this->article_model->get_some_articles(4, 0);
			$this->load->view('internaute/details_article', $result);
		}

	}

	public function error()
	{
		$this->load->view('internaute/error');

	}

	public function categories()
	{
		$categorie = $this->uri->segment(3);
		img(base_url().'assets/user/images/parallax/'.$categorie.'jpg');
		$result['les_articles'] = $this->article_model->get_all_categorie_articles($categorie);
		$result['categorie'] = $categorie;
		$this->load->view('internaute/articles_by_categorie', $result);
	}

	public function submit_update_article()
	{
		$this->form_validation->set_rules('titre', 'Titre', 'required|trim|min_length[5]');
		$this->form_validation->set_rules('categorie', 'Catégorie', 'required');
		$this->form_validation->set_rules('details', 'Contenu', 'required|trim|min_length[5]');
		$config['upload_path'] = './pictures/';
		$config['allowed_types'] = 'gif|jpeg|png|jpg';
		$config['file_name'] = time().rand(1, 2020);
		$config['max_size'] = 20480;
		$config['max_width'] = 10240;
		$config['max_height'] = 10240;
		$config['overwrite'] = false;

		$this->load->library('upload', $config);

		if(($this->form_validation->run()==FALSE) ){
			$result = $this->compte();
			$result['update_data'] = $this->article_model->get_an_article($this->input->post('id'));
			$this->load->view('admin/edit_article', $result);
		}else {
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
				'img_path' =>$file_name,
				'img_comment' =>$commentaire,
				'contenu' =>$details,
				'date_mod' =>date('Y-m-d H:i:s', time())
			);

			$query_result = $this->article_model->insert_article_update($reg_id, $reg_details);

			if($query_result == true)
			{
				$this->session->set_flashdata('msg', 'update_true');
				redirect('article/all_article_page', 'refresh');
			}else {
				$this->session->set_flashdata('msg', 'update_false');
				redirect('article/all_article_page', 'refresh');
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

	public function annual_archive()
	{
		$annee = $this->uri->segment(3);
		$result['les_articles'] = $this->article_model->get_annual_archives($annee);
		$result['annee'] = $annee;
		$this->load->view('internaute/archives_by_year', $result);
	}

	public function get_user_ip()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip =$_SERVER['HTTP_CLIENT_IP'];
		}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
	}
}
