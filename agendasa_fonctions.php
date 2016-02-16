<?php
/**
 * Fonctions utiles au plugin Agenda sans article
 *
 * @plugin     Agenda sans article
 * @copyright  2016
 * @author     vertige
 * @licence    GNU/GPL
 * @package    SPIP\Agendasa\Fonctions
 */

if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}

function formulaires_editer_evenement_verifier(
	$id_evenement = 'new',
	$id_article = 0,
	$retour = '',
	$lier_trad = 0,
	$config_fonc = 'evenements_edit_config',
	$row = array(),
	$hidden = ''
) {
    $erreurs = formulaires_editer_objet_verifier('evenement', $id_evenement, array('titre', 'date_debut', 'date_fin'));
    include_spip('inc/date_gestion');

    $horaire = _request('horaire')=='non' ? false : true;
    if (!$erreurs['date_debut']) {
        $date_debut = verifier_corriger_date_saisie('debut', $horaire, $erreurs);
    }

    if (!$erreurs['date_fin']) {
        $date_fin = verifier_corriger_date_saisie('fin', $horaire, $erreurs);
    }

    if ($date_debut and $date_fin and $date_fin<$date_debut) {
        $erreurs['date_fin'] = _T('agenda:erreur_date_avant_apres');
    }

    include_spip('formulaires/selecteur/selecteur_fonctions');
    if (count($id = picker_selected(_request('parents_id'), 'article'))
		and $id = reset($id)
		and $id = sql_getfetsel('id_article', 'spip_articles', 'id_article='.intval($id))) {
        // reinjecter dans id_parent
		set_request('id_parent', $id);
    }

    if (!$id_parent = intval(_request('id_parent'))) {
        $erreurs['id_parent'] = _T('agenda:erreur_article_manquant');
    } else {
        if (!autoriser('creerevenementdans', 'article', $id_parent)) {
            $erreurs['id_parent'] = _T('agenda:erreur_article_interdit');
        }
    }

	#if (!count($erreurs))
	#	$erreurs['message_erreur'] = 'ok?';
	return $erreurs;
}
