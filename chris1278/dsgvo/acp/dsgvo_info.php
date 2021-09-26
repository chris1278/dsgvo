<?php
/**
*
* For DSGVO/GDPR Private Download´s Extension by Chris1278
*
* @copyright (c) 2020 (Christian-Esch.de)
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

namespace chris1278\dsgvo\acp;

class dsgvo_info
{
	function module()
	{
		return [
			'filename'		=> 'chris1278\dsgvo\dsgvo_module',
			'title'			=> 'ACP_DSGVO_TITLE',
			'version'		=> '1.0.0',
			'modes'			=> [
				'settings'    => [
					'title'		=> 'ACP_DSGVO_SETTINGS',
					'auth'		=> 'ext_chris1278/dsgvo && acl_a_board',
					'cat'		=> ['ACP_DSGVO_TITLE']
				]
			],
		];
		return [
			'filename'		=> 'chris1278\dsgvo\dsgvo_module',
			'title'			=> 'ACP_QUICK_ACCESS',
			'version'		=> '1.0.0',
			'modes'			=> [
				'settings'    => [
					'title'		=> 'ACP_QUICK_DSGVO_SETTINGS',
					'auth'		=> 'ext_chris1278/dsgvo && acl_a_board',
					'cat'		=> ['ACP_QUICK_ACCESS']
				]
			],
		];
	}
}
