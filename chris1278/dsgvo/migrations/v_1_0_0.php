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

class v_1_0_0 extends \phpbb\db\migration\migration
	{
	public static function depends_on()
	{
		return ['\chris1278\dsgvo\migrations\permission'];
	}

	public function update_data()
	{
		return [
			['config.add', ['dsgvo_post_format', 1]],
			['config.add', ['dsgvo_post_read', 0]],
			['config.add', ['dsgvo_post_unapproved', 1]],
			['config.add', ['dsgvo_post_deleted', 1]],
		];
	}
}
