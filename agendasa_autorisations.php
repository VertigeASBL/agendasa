<?php
/**
 * Définit les autorisations du plugin Agenda sans article
 *
 * @plugin     Agenda sans article
 * @copyright  2016
 * @author     vertige
 * @licence    GNU/GPL
 * @package    SPIP\Agendasa\Autorisations
 */

if (!defined('_ECRIRE_INC_VERSION')) return;


/*
 * Un fichier d'autorisations permet de regrouper
 * les fonctions d'autorisations de votre plugin
 */

/**
 * Fonction d'appel pour le pipeline
 * @pipeline autoriser */
function agendasa_autoriser(){}

/**
 * Autorisation de modifier un evenement : autorisations de l'article parent
 *
 * @param string $faire
 * @param string $quoi
 * @param int $id
 * @param int $qui
 * @param array $options
 * @return bool
 */
function autoriser_evenement_modifier($faire,$quoi,$id,$qui,$options){
	if (!isset($options['id_article']) OR !$id_article=$options['id_article'])
		$id_article = sql_getfetsel('id_article','spip_evenements','id_evenement='.intval($id));
	if (!$id_article) return false;
	return autoriser('modifier','article',$id_article,$qui);
}