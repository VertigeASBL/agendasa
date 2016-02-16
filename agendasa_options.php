<?php
/**
 * Options au chargement du plugin Agenda sans article
 *
 * @plugin     Agenda sans article
 * @copyright  2016
 * @author     vertige
 * @licence    GNU/GPL
 * @package    SPIP\Agendasa\Options
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

// Empecher le chargement du pipeline agenda_affiche_milieu
$GLOBALS['spip_pipeline']['affiche_milieu'] = str_replace(
	'|agenda_affiche_milieu',
	'',
	$GLOBALS['spip_pipeline']['affiche_milieu']
);

unset($GLOBALS['spip_matrice']['agenda_affiche_milieu']);
