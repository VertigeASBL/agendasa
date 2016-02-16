<?php

/**
 *  Fichier généré par la Fabrique de plugin v6
 *   le 2016-02-16 10:13:07
 *
 *  Ce fichier de sauvegarde peut servir à recréer
 *  votre plugin avec le plugin «Fabrique» qui a servi à le créer.
 *
 *  Bien évidemment, les modifications apportées ultérieurement
 *  par vos soins dans le code de ce plugin généré
 *  NE SERONT PAS connues du plugin «Fabrique» et ne pourront pas
 *  être recréées par lui !
 *
 *  La «Fabrique» ne pourra que régénerer le code de base du plugin
 *  avec les informations dont il dispose.
 *
**/

if (!defined("_ECRIRE_INC_VERSION")) return;

$data = array (
  'fabrique' => 
  array (
    'version' => 6,
  ),
  'paquet' => 
  array (
    'prefixe' => 'agendasa',
    'nom' => 'Agenda sans article',
    'slogan' => 'Utiliser les événéments de l\'agenda sans article',
    'description' => '',
    'logo' => 
    array (
      0 => '',
    ),
    'version' => '1.0.0',
    'auteur' => 'vertige',
    'auteur_lien' => 'http://www.vertige.org',
    'licence' => 'GNU/GPL',
    'categorie' => 'date',
    'etat' => 'dev',
    'compatibilite' => '[3.1.0;3.1.*]',
    'documentation' => '',
    'administrations' => 'on',
    'schema' => '1.0.0',
    'formulaire_config' => '',
    'formulaire_config_titre' => '',
    'fichiers' => 
    array (
      0 => 'autorisations',
      1 => 'fonctions',
      2 => 'options',
      3 => 'pipelines',
    ),
    'inserer' => 
    array (
      'paquet' => '',
      'administrations' => 
      array (
        'maj' => '',
        'desinstallation' => '',
        'fin' => '',
      ),
      'base' => 
      array (
        'tables' => 
        array (
          'fin' => '',
        ),
      ),
    ),
    'scripts' => 
    array (
      'pre_copie' => '',
      'post_creation' => '',
    ),
    'exemples' => 'on',
  ),
  'objets' => 
  array (
  ),
  'images' => 
  array (
    'paquet' => 
    array (
      'logo' => 
      array (
        0 => 
        array (
          'extension' => 'png',
          'contenu' => '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',
        ),
      ),
    ),
    'objets' => 
    array (
    ),
  ),
);