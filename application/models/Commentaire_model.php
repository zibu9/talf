<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commentaire_model extends CI_Model
{
	/**
	 * Class constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function get_all_article_comments($id_article) {
		$query= $this->db->query('SELECT commentaires.*,  year(commentaires.date_pub) AS annee, month(commentaires.date_pub) AS mois, day(commentaires.date_pub) AS jour, hour(commentaires.date_pub) AS heure, minute(commentaires.date_pub) AS minute FROM commentaires WHERE id_article = '.$id_article.' ORDER BY date_pub DESC');
		return $query->result();
	}

	public function get_an_article($id) {
		$query= $this->db->query('SELECT articles.*, year(articles.date_pub) AS annee, month(articles.date_pub) AS mois, day(articles.date_pub) AS jour, hour(articles.date_pub) AS heure, minute(articles.date_pub) AS minute, year(articles.date_mod) AS annee_mod, month(articles.date_mod) AS mois_mod, day(articles.date_mod) AS jour_mod, hour(articles.date_mod) AS heure_mod, minute(articles.date_mod) AS minute_mod, year(articles.date_archive) AS annee_archive, month(articles.date_archive) AS mois_archive, day(articles.date_archive) AS jour_archive, hour(articles.date_archive) AS heure_archive, minute(articles.date_archive) AS minute_archive FROM articles WHERE articles.id = '.$id);
		return $query->row();
	}

	public function delete_commentaire_model($id) {
		$this->db->where('id', $id);
		$result = $this->db->delete('commentaires');
		if ($result == true) {
			return true;
		} else {
			return false;
		}
	}

	public function get_a_comment($id) {
		$this->db->where('id', $id);
		$query= $this->db->get('commentaires');
		return $query->row();
	}

	public function insert_article_comment($reg_details)
	{
		if($this->db->insert('commentaires', $reg_details))
		{
			return true;
		}else {
			return false;
		}
	}

}
