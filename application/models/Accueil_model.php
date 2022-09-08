<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accueil_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_all() {
		$query= $this->db->query('SELECT * FROM accueil WHERE  id = 1');
		return $query->row();
	}

	public function get_a() {
		$query= $this->db->query('SELECT * FROM accueil WHERE  id = 1');
		return $query->result();
	}

	public function get_equipe() {
		$query= $this->db->query('SELECT * FROM equipe');
		return $query->result();
	}

	public function get_eq($id) {
		$query= $this->db->query('SELECT * FROM equipe WHERE id = '.$id);
		return $query->row();
	}

	public function u_propos($donnees){


		$this->db->set($donnees);
		$this->db->where('id', 1);
		$this->db->update('accueil');
		return true;
		

	}	

	public function u_objectifs($donnees)
	{
		$this->db->set($donnees);
		$this->db->where('id', 1);
		$this->db->update('accueil');
		return true;
		
	}
}
