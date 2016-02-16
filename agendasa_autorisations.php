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

if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}


/*
 * Un fichier d'autorisations permet de regrouper
 * les fonctions d'autorisations de votre plugin
 */

/**
 * Fonction d'appel pour le pipeline
 * @pipeline autoriser */
function agendasa_autoriser() {}

/**
 * Autorisation de modifier un evenement
 * Par défaut, seul les administrateurs on cette capacité
 *
 * @param string $faire
 * @param string $quoi
 * @param int $id
 * @param int $qui
 * @param array $options
 * @return bool
 */
function autoriser_evenement_modifier($faire, $quoi, $id, $qui, $options) {
    return in_array($qui['statut'], array('0minirezo'));
}

/**
 * Autorisation d'instituer un evenement : voir si l'article est publie ou non
 *
 * @param string $faire
 * @param string $quoi
 * @param int $id
 * @param int $qui
 * @param array $options
 * @return bool
 */
function autoriser_evenement_instituer($faire,$quoi,$id,$qui,$options){
	if (!isset($options['id_article']) OR !$id_article=$options['id_article'])
		$id_article = sql_getfetsel('id_article','spip_evenements','id_evenement='.intval($id));
	if (!$id_article) return false;
	$statut = sql_getfetsel('statut','spip_articles','id_article='.intval($id_article));
	// interdit de publier un evenement sur un article non publie
	if ($statut!=='publie'
	  AND isset($options['statut'])
		AND $options['statut']=='publie')
		return false;
	$options['id_article']=$id_article;
	return autoriser('modifier','evenement',$id,$qui,$options);
}
