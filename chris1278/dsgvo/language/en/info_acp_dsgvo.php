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
	'DSGVO_LANG_DESC'							=>	'English (en)',
	'DSGVO_LANG_EXT_VER' 						=>	'1.0.0',
	'DSGVO_LANG_AUTHOR' 						=>	'Chris1278',
	'DSGVO_DESC' 								=>	'Here the settings for the extension „%1$s“ (v%2$s) can be changed.',
	'DSGVO_MSG_LANGUAGEPACK_OUTDATED'			=>	'Note: The language pack for this extension is no longer up-to-date',
	//Settings ACP
	'ACP_DSGVO_TITLE'							=>	'DSGVO/GDPR Private Download´s',
	'ACP_QUICK_DSGVO_SETTINGS'					=>	'DSGVO/GDPR Private Download´s',
	'ACP_DSGVO_SETTINGS'						=>	'Settings',
	'ACP_DSGVO_DOWNLOAD_OPTIONS'				=>	'Data Download',
	'ACP_DSGVO_POST_FORMAT'						=>	'Posts',
	'ACP_DSGVO_POST_FORMAT_EXPLAIN'				=>	'Choose what to include when downloading posts.',
	'DSGVO_ALL'									=>	'Text and Meta-Data',
	'DSGVO_META'								=>	'Only Meta-Data',
	'DSGVO_READ'								=>	'Restrict to messages with read access',
	'ACP_DSGVO_POST_READ'						=>	'Visible messages only',
	'ACP_DSGVO_POST_READ_EXPLAIN'				=>	'Shall the download of messages be restricted to those a user has read access to?',
	'ACP_DSGVO_POST_UNAPPROVED'					=>	'Messages pending approval',
	'ACP_DSGVO_POST_UNAPPROVED_EXPLAIN'			=>	'Shall messages still pending approval be included in the download?',
	'ACP_DSGVO_POST_DELETED'					=>	'Deleted messages',
	'ACP_DSGVO_POST_DELETED_EXPLAIN'			=>	'Shall deleted messages be included in the download?',
	'DSGVO_SAVE'								=>	'The settings for the DSGVO/GDPR extension were successfully adopted!',
]);
