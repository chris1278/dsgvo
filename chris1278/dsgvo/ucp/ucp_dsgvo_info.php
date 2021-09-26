<?php
/**
*
* For DSGVO/GDPR Private Download´s Extension by Chris1278
*
* @copyright (c) 2020 (Christian-Esch.de)
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

namespace chris1278\dsgvo\ucp;

class ucp_dsgvo_info
{
	function module()
	{
		return [
			'filename' => '\chris1278\dsgvo\ucp\ucp_dsgvo_module',
			'title' => 'UCP_DSGVO_MODULE',
			'modes' => [
				'font' => [
					'title'	=> 'UCP_DSGVO_SETTINGS',
					'auth' => 'ext_chris1278/dsgvo',
					'cat' => ['UCP_DSGVO_MODULE'],
				],
			],
		];
	}
}
