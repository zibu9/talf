<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('site_url'))
{
	function site_url($uri = '')
	{
		if( ! is_array($uri))
		{
			// Tous les paramètres sont insérés dans un tableau
			$uri = func_get_args();
		}
		$CI =& get_instance();
		return $CI->config->site_url($uri);
	}
}
// ------------------------------------------------------------------------
if ( ! function_exists('url'))
{
	function url($text, $uri = '')
	{
		if( ! is_array($uri))
		{
			// Suppression de la variable $text
			$uri = func_get_args();
			array_shift($uri);
		}
		echo '<a href="' . site_url($uri) . '">' . htmlentities($text) .'</a>';
		return '';
	}
}

if ( ! function_exists('tronque'))
{
function tronque($chaine, $max){
	if(strlen($chaine)>=$max){
		$chaine = substr($chaine, 0, $max);
		$sp = strrpos($chaine, " ");
		if($sp)
			$chaine = substr($chaine, 0, $sp);
		$chaine.= '...';
   }
   return $chaine;
}
}
if ( ! function_exists('mois'))
{
	function mois($month)
	{
		switch ($month) {
			case 1:
				return "Janvier";
				break;
			case 2:
				return "Février";
				break;
			case 3:
				return "Mars";
				break;
			case 4:
				return "Avril";
				break;
			case 5:
				return "Mai";
				break;
			case 6:
				return "Juin";
				break;
			case 7:
				return "Juillet";
				break;
			case 8:
				return "Août";
				break;
			case 9:
				return "Septembre";
				break;
			case 10:
				return "Octobre";
				break;
			case 11:
				return "Novembre";
				break;
			case 12:
				return "Décembre";
				break;
			default:
				return '';
		}
	}
}
/* End of file MY_url_helper.php */
/* Location: ./application/helpers/MY_url_helper.php */
