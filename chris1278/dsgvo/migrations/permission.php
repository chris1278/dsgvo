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

class permission extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return ['\chris1278\dsgvo\migrations\ucp_module'];
	}

	public function update_data()
	{
		return [
			['permission.add', ['u_dsgvo_profile_download']],
				['permission.permission_set', ['REGISTERED', 'u_dsgvo_profile_download', 'group']],
			['permission.add', ['u_dsgvo_posts_download']],
				['permission.permission_set', ['REGISTERED', 'u_dsgvo_posts_download', 'group']],
		];
	}
}
