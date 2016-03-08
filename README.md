# Agenda sans article

Il faut un article qui va concentrer tout les événements. S'il n'y en a pas, les événements seront automatiquements supprimé par [la fonction d'optimisation](http://zone.spip.org/trac/spip-zone/browser/_plugins_/agenda/trunk/agenda_pipelines.php#L100) déclarée dans agenda.

Il suffit de déclarer la constante _ID_ARTICLE_AGENDA

```php
define('_ID_ARTICLE_AGENDA', 1);
```
