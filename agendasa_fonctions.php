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

	return $erreurs;
}

function formulaires_editer_evenement_traiter(
	$id_evenement = 'new',
	$id_article = 0,
	$retour = '',
	$lier_trad = 0,
	$config_fonc = 'evenements_edit_config',
	$row = array(),
	$hidden = ''
) {
	set_request('horaire', _request('horaire')=='non' ? 'non' : 'oui');
	set_request('inscription', _request('inscription') ? 1 : 0);
	include_spip('inc/date_gestion');
	$erreurs = array();
	$date_debut = verifier_corriger_date_saisie('debut', _request('horaire')=='oui', $erreurs);
	$date_fin = verifier_corriger_date_saisie('fin', _request('horaire')=='oui', $erreurs);
	set_request('date_debut', date('Y-m-d H:i:s', $date_debut));
	set_request('date_fin', date('Y-m-d H:i:s', $date_fin));

	$res = formulaires_editer_objet_traiter('evenement', $id_evenement, $id_article, 0, $retour, $config_fonc, $row, $hidden);
	// si c'est une creation dans un article publie, passer l'evenement en publie
	// l'article peut être renseigné/modifié par l'utilisateur dans le formulaire. On le retrouve.
	if (!intval($id_evenement)
	    and $id_article = sql_getfetsel('id_article', 'spip_evenements', 'id_evenement='.$res['id_evenement'])
	    and objet_test_si_publie('article', $id_article)) {
		// sera refuse si auteur pas autorise
		evenement_modifier($res['id_evenement'], array('statut'=>'publie'));
	}
	// a la creation, documenter la date de creation
	if (!intval($id_evenement)) {
		evenement_modifier($res['id_evenement'], array('date_creation'=>date('Y-m-d H:i:s')));
	}

	$id_evenement = $res['id_evenement'];
	if ($res['redirect']) {
		if (strpos($res['redirect'], 'article')!==false) {
			$id_article = sql_getfetsel('id_article', 'spip_evenements', 'id_evenement='.intval($id_evenement));
			$res['redirect'] = parametre_url($res['redirect'], 'id_article', $id_article);
		}
	}
	return $res;
}
