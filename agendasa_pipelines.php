<?php
/**
 * Utilisations de pipelines par Agenda sans article
 *
 * @plugin     Agenda sans article
 * @copyright  2016
 * @author     vertige
 * @licence    GNU/GPL
 * @package    SPIP\Agendasa\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

function agendasa_header_prive($flux) {
	return $flux.'<link rel="stylesheet" type="text/css" media="all" href="'.find_in_path('css/cacher_agenda.css').'" />';
}


/**
 * Restaurer la prévisualisation des événements
 *
 * @param array $tables
 * @access public
 * @return array
 */
function agendasa_declarer_tables_objets_sql($tables) {

	$tables['spip_evenements']['statut'][0]['previsu'] = 'prop';
	return $tables;
}
