<?php
/**
*
* For DSGVO/GDPR Private Download´s Extension by Chris1278
*
* @copyright (c) 2020 (Christian-Esch.de)
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

namespace chris1278\dsgvo\migrations;

class acp_module extends \phpbb\db\migration\migration
{

	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v310\dev'];
	}

	public function update_data()
	{
		return [
			['module.add', [
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_DSGVO_TITLE'
			]],
			['module.add', [
				'acp',
				'ACP_DSGVO_TITLE', [
					'module_basename'	=> '\chris1278\dsgvo\acp\dsgvo_module',
					'module_langname'	=> 'ACP_DSGVO_SETTINGS',
					'module_mode'		=> 'overview',
					'module_auth'		=> 'ext_chris1278/dsgvo && acl_a_board',
				]
			]],
			['module.add', [
				'acp',
				'ACP_QUICK_ACCESS', [
					'module_basename'	=> '\chris1278\dsgvo\acp\dsgvo_module',
					'module_langname'	=> 'ACP_QUICK_DSGVO_SETTINGS',
					'module_mode'		=> 'acp_dsgvo_quick',
					'module_auth'		=> 'ext_chris1278/dsgvo && acl_a_board',
				]
			]],
		];
	}
}
