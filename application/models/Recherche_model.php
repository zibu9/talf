<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recherche_model extends CI_Model
{
	private $table = 'articles';
	/**
	 * Class constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}
	public function search($details)
	{
		$query = $this->db->query('SELECT articles.*, year(articles.date_pub) AS annee, month(articles.date_pub) AS mois, day(articles.date_pub) AS jour, hour(articles.date_pub) AS heure, minute(articles.date_pub) AS minute FROM articles  WHERE archive = "non" AND titre LIKE "%'.$details.'%" ORDER BY id DESC');
		return $query->result();
	}

	public function search_a($details, $details2)
	{
		$query = $this->db->query('SELECT articles.*, year(articles.date_pub) AS annee, month(articles.date_pub) AS mois, day(articles.date_pub) AS jour, hour(articles.date_pub) AS heure, minute(articles.date_pub) AS minute FROM articles  WHERE archive = "non" AND titre LIKE "%'.$details.'%" OR titre LIKE "%'.$details2.'%" ORDER BY id DESC');
		return $query->result();
	}

	public function search_last($details, $details2, $details3)
	{
		$query = $this->db->query('SELECT articles.*, year(articles.date_pub) AS annee, month(articles.date_pub) AS mois, day(articles.date_pub) AS jour, hour(articles.date_pub) AS heure, minute(articles.date_pub) AS minute FROM articles  WHERE archive = "non" AND titre LIKE "%'.$details.'%" OR titre LIKE "%'.$details2.'%" OR titre LIKE "%'.$details3.'%" ORDER BY id DESC');
		return $query->result();
	}

	public function search_again($details)
	{
		$query = $this->db->query('SELECT articles.*, year(articles.date_pub) AS annee, month(articles.date_pub) AS mois, day(articles.date_pub) AS jour, hour(articles.date_pub) AS heure, minute(articles.date_pub) AS minute FROM articles  WHERE archive = "non" AND CONCAT(titre, contenu) LIKE "%'.$details.'%" ORDER BY id DESC');
		return $query->result();
	}
}
