<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends CI_Model
{
	private $table = 'articles';
	/**
	 * Class constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	public function insert_article($reg_details)
	{
		//$this->db->insert('Table_name', $Object);
		if($this->db->insert('articles', $reg_details))
		{
			return true;
		}else {
			return false;
		}
	}

    public function to_count()
    {
       		$query = $this->db->query('SELECT COUNT(articles.id) AS ct FROM articles');
				foreach ($query->result() as $row)
				{
			        return (int)$row->ct;
				}   
	 }

	public function get_all_articles() {
		$query= $this->db->query('SELECT * FROM articles ORDER BY date_pub DESC');
		return $query->result();
	}

	public function get_some_articles($nb, $debut = 0) {        
		$query = $this->db->query('SELECT articles.*, COUNT(commentaires.id_article) AS commentaire, year(articles.date_pub) AS annee, month(articles.date_pub) AS mois, day(articles.date_pub) AS jour, hour(articles.date_pub) AS heure, minute(articles.date_pub) AS minute FROM articles LEFT JOIN commentaires ON(articles.id = commentaires.id_article) GROUP BY articles.id ORDER BY articles.date_pub DESC LIMIT '.$debut.','.$nb);
		return $query->result();
	}

	public function get_an_article($id) {
		$query= $this->db->query('SELECT articles.*, year(articles.date_pub) AS annee, month(articles.date_pub) AS mois, day(articles.date_pub) AS jour, hour(articles.date_pub) AS heure, minute(articles.date_pub) AS minute FROM articles WHERE articles.id = '.$id);
		return $query->row();
	}

	public function get_article_by_titre($titre) {
		$this->db->select('id');
		$this->db->from('articles');
		$this->db->where('titre', $titre);
		$query= $this->db->get();
		foreach ($query->result() as $row)
		{
	        return $row->id;
		}
	}

	public function like_article_model($id)
	{
		$result = $this->db->query('UPDATE articles SET nb_like = nb_like +1 WHERE articles.id = '.$id);
		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	public function view_article_model($id)
	{
		$result = $this->db->query('UPDATE articles SET nb_vues = nb_vues + 1 WHERE articles.id = '.$id);
		if ($result) {
			return true;
		} else {
			return false;
		}
	}
	public function get_all_article_comments($id_article) {
		$query= $this->db->query('SELECT commentaires.*,  year(commentaires.date_pub) AS annee, month(commentaires.date_pub) AS mois, day(commentaires.date_pub) AS jour, hour(commentaires.date_pub) AS heure, minute(commentaires.date_pub) AS minute FROM commentaires WHERE id_article = '.$id_article.' ORDER BY date_pub DESC');
		return $query->result();
	}

	public function count_journ() {
		$query = $this->db->query('SELECT COUNT(*) AS cpt_journ FROM journalistes');
		return $query->row();
	}

	public function get_articles_by_views() {
		$query = $this->db->query('SELECT articles.*, COUNT(commentaires.id_article) AS commentaire, year(articles.date_pub) AS annee, month(articles.date_pub) AS mois, day(articles.date_pub) AS jour, hour(articles.date_pub) AS heure, minute(articles.date_pub) AS minute FROM articles LEFT JOIN commentaires ON(articles.id = commentaires.id_article) GROUP BY articles.id ORDER BY articles.nb_vues DESC, articles.date_pub DESC LIMIT 10');
		return $query->result();
	}
}
