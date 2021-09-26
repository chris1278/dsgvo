<?php
/**
*
* For DSGVO/GDPR Private Download´s Extension by Chris1278
*
* @copyright (c) 2020 (Christian-Esch.de)
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}
if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [
	// Information For Versionscheck Metadaten
	'DSGVO_LANG_DESC'							=>	'Deutsch (Du)',
	'DSGVO_LANG_EXT_VER' 						=>	'1.0.0',
	'DSGVO_LANG_AUTHOR' 						=>	'Chris1278',
	'DSGVO_DESC' 								=>	'Hier können die Einstellungen für die Erweiterung „%1$s“ (v%2$s) geändert werden.',
	'DSGVO_MSG_LANGUAGEPACK_OUTDATED'			=>	'Hinweis: Das Sprachpaket dieser Erweiterung ist nicht mehr aktuell',
	//Settings ACP
	'ACP_DSGVO_TITLE'							=>	'DSGVO/GDPR Private Download´s',
	'ACP_QUICK_DSGVO_SETTINGS'					=>	'DSGVO/GDPR Private Download´s',
	'ACP_DSGVO_SETTINGS'						=>	'Einstellungen',
	'ACP_DSGVO_DOWNLOAD_OPTIONS'				=>	'Daten Download',
	'ACP_DSGVO_POST_FORMAT'						=>	'Beiträge',
	'ACP_DSGVO_POST_FORMAT_EXPLAIN'				=>	'Wähle aus, was beim Download von Beiträgen enthalten sein soll.',
	'DSGVO_ALL'									=>	'Text und Meta-Daten',
	'DSGVO_META'								=>	'Nur Meta-Daten',
	'DSGVO_READ'								=>	'Nur Beiträge mit Leserecht',
	'ACP_DSGVO_POST_READ'						=>	'Nur lesbare Beiträge',
	'ACP_DSGVO_POST_READ_EXPLAIN'				=>	'Soll der Download der Beiträge auf Foren beschränkt werden, die der Benutzer lesen kann?',
	'ACP_DSGVO_POST_UNAPPROVED'					=>	'Ungeprüfte Beiträge',
	'ACP_DSGVO_POST_UNAPPROVED_EXPLAIN'			=>	'Sollen ungeprüfte Beiträge enthalten sein?',
	'ACP_DSGVO_POST_DELETED'					=>	'Gelöschte Beiträge',
	'ACP_DSGVO_POST_DELETED_EXPLAIN'			=>	'Sollen gelöschte Beiträge enthalten sein?',
	'DSGVO_SAVE'								=>	'Die Einstellungen für die DSGVO-Erweiterung wurden Erfolgreich übernommen!',
]);
