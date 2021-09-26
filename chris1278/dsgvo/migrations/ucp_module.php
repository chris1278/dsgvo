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

class ucp_module extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return ['\chris1278\dsgvo\migrations\acp_module'];
	}

	public function update_data()
	{
		return [
			['module.add', [
				'ucp',
				'',
				'UCP_DSGVO_MODULE'
			]],
			['module.add', [
				'ucp',
				'UCP_DSGVO_MODULE', [
					'module_basename'	=> '\chris1278\dsgvo\ucp\ucp_dsgvo_module',
					'module_langname'	=> 'UCP_DSGVO_OVERVIEW',
					'module_mode'		=> 'dsgvo_overview',
					'module_auth'		=> 'ext_chris1278/dsgvo && acl_u_dsgvo_overview',
				]
			]],
			['module.add', [
				'ucp',
				'UCP_DSGVO_MODULE', [
					'module_basename'	=> '\chris1278\dsgvo\ucp\ucp_dsgvo_module',
					'module_langname'	=> 'UCP_DSGVO_PROFILE',
					'module_mode'		=> 'profile_download',
					'module_auth'		=> 'ext_chris1278/dsgvo && acl_u_dsgvo_profile_download',
				]
			]],
			['module.add', [
				'ucp',
				'UCP_DSGVO_MODULE', [
					'module_basename'	=> '\chris1278\dsgvo\ucp\ucp_dsgvo_module',
					'module_langname'	=> 'UCP_DSGVO_DATA',
					'module_mode'		=> 'data_download',
					'module_auth'		=> 'ext_chris1278/dsgvo && acl_u_dsgvo_posts_download',
				]
			]],
		];
	}
}
