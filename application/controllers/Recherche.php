<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recherche extends CI_Controller
{
    const NB_ARTICLE_PAR_PAGE = 6;
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('recherche_model');
		$this->load->model('article_model');
        $this->load->library('pagination');
	}

	public function index()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('search',  '"Search"',  'trim|required|min_length[3]');
		$data['les_articles'] = $this->article_model->get_some_articles(4, 4);
        $data['les_article'] = $this->article_model->get_some_articles(4, 0); 
        if($this->form_validation->run())
        {
            $search = $this->input->post('search');
            $data['var'] = $search;
            $data['recherches'] = $this->recherche_model->search($search);
            $recherche = $this->recherche_model->search($search);
            $data['nbre'] = count($recherche, COUNT_NORMAL);

            if (empty($recherche)) {

                $mots = explode(" ", $search);
                $n = count($mots, COUNT_NORMAL);
                for ($i=0;$i<$n-1;$i++) { 
                    $long = $i;
                    for ($j=$i+1;$j<$n;$j++)
                        if(((strlen($mots[$j]))>(strlen($mots[$long])))){
                              $long=$j;
                              $temp= $mots[$i];
                              $mots[$i]=$mots[$long];
                              $mots[$long]=$temp;}
                }
                    if($n>1){
                        $a=($mots[0]);
                        $b=($mots[1]);
                    $data['recherches'] = $this->recherche_model->search_a($a, $b);
                    $rech = $this->recherche_model->search_a($a, $b);
                    $data['nbre'] = count($rech, COUNT_NORMAL); 
                        $data["var1"] = $mots[0];
                        $data["var2"] = $mots[1];
                    $this->load->view('internaute/recherche',$data);                        
                    }
                    if (empty($rech)AND ($n>2)) {
                        $c=($mots[2]);
                        $data['recherches'] = $this->recherche_model->search_last($a, $b, $c);
                        $rech = $this->recherche_model->search_last($a, $b, $c);
                        $data['nbre'] = count($rech, COUNT_NORMAL); 
                        $data["var1"] = $mots[0];
                        $data["var2"] = $mots[1];
                        $this->load->view('internaute/recherche',$data); 
                    }else{

                        $data['recherches'] = $this->recherche_model->search_again($search);
                        $recherche = $this->recherche_model->search_again($search);
                        $data['nbre'] = count($recherche, COUNT_NORMAL); 

                            $this->load->view('internaute/recherche',$data);
                    }
                
            }

             else {
            	$this->load->view('internaute/recherche',$data);
            }

        }
        else
        {
            redirect('article/');
        }
	}


}
