<?php
/**
*
* For DSGVO/GDPR Private Download´s Extension by Chris1278
*
* @copyright (c) 2020 (Christian-Esch.de)
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

namespace chris1278\dsgvo\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ucp_listener implements EventSubscriberInterface
{
	protected $auth;
	protected $config;
	protected $db;
	protected $phpbb_dispatcher;
	protected $user;
	protected $template;
	protected $phpbb_root_path;
	protected $php_ext;

	public function __construct(
		\phpbb\auth\auth $auth,
		\phpbb\config\config $config,
		\phpbb\db\driver\driver_interface $db,
		\phpbb\event\dispatcher_interface $phpbb_dispatcher,
		\phpbb\user $user,
		\phpbb\template\template $template,
		$phpbb_root_path,
		$php_ext
	)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->db = $db;
		$this->phpbb_dispatcher = $phpbb_dispatcher;
		$this->user = $user;
		$this->template = $template;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	public static function getSubscribedEvents()
	{
		return [
			'core.permissions'									=>	'permissions',
			'core.ucp_display_module_before'					=>	[['seperate_permissions'], ['dsgvo_profile_download'], ['dsgvo_posts_download']],
		];
	}

	public function permissions($event)
	{
		$permissions = $event['permissions'];
		$permissions += [
			'u_dsgvo_overview'	=> [
				'lang'		=> 'ACL_U_DSGVO_OVERVIEW',
				'cat'		=> 'profile'
			],
			'u_dsgvo_profile_download'	=> [
				'lang'		=> 'ACL_U_DSGVO_PROFILE_DOWNLOAD',
				'cat'		=> 'profile'
			],
			'u_dsgvo_posts_download'	=> [
				'lang'		=> 'ACL_U_DSGVO_POSTS_DOWNLOAD',
				'cat'		=> 'profile'
			],
		];

		$event['permissions'] = $permissions;
	}

	public function seperate_permissions ()
	{
		$this->template->assign_vars([
			'DSGVO_PROFILE_DOWNLOAD'		=>	$this->auth->acl_get('u_dsgvo_profile_download'),
			'DSGVO_POSTS_DOWNLOAD'			=>	$this->auth->acl_get('u_dsgvo_posts_download'),
		]);
	}

	public function dsgvo_profile_download ($event)
	{
		switch ($event['mode'])
		{
			case 'profile_download':
				$this->template->assign_vars([
					'U_DSGVO_PROFILE_DOWNLOAD'		=> $this->auth->acl_get('u_dsgvo_profile_download') ? append_sid("{$this->phpbb_root_path}ucp.$this->php_ext", 'mode=dsgvo_profile_download') : '',
					]);
				break;

			case 'dsgvo_profile_download':
				$sql = 'SELECT user_id, user_ip, user_regdate, username, user_email, user_lastvisit, user_posts, user_lang, user_timezone, user_dateformat,
						user_avatar, user_sig, user_jabber
					FROM ' .  USERS_TABLE . '
					WHERE user_id = ' . (int) $this->user->data['user_id'];
				$result = $this->db->sql_query($sql);
				$user_row = $this->db->sql_fetchrow($result);

				$user_row['user_regdate'] = $this->user->format_date($user_row['user_regdate']);
				$user_row['user_lastvisit'] = $this->user->format_date($user_row['user_lastvisit']);

				$sql = 'SELECT *
					FROM ' .  PROFILE_FIELDS_DATA_TABLE . '
					WHERE user_id = ' . (int) $this->user->data['user_id'];
				$result = $this->db->sql_query($sql);
				$profile_fields_row = $this->db->sql_fetchrow($result);
				$profile_fields_row = is_array($profile_fields_row) ? $profile_fields_row : [];

				$sql = 'SELECT session_id, session_last_visit, session_ip, session_browser
					FROM ' .  SESSIONS_TABLE . '
					WHERE session_user_id = ' . (int) $this->user->data['user_id'];
				$result = $this->db->sql_query($sql);
				$session_row = $this->db->sql_fetchrow($result);

				$session_row['session_last_visit'] = $this->user->format_date($session_row['session_last_visit']);

				$data = array_merge($user_row, $session_row, $profile_fields_row);
				/**
				 * Add or modify user data in chris1278 dsgvo/gdpr private downloads extension
				 *
				 * @event chris1278.dsgvo.dsgvo_profile_download
				 * @var    array	data		The user data row
				 * @since 1.1.0
				 */

				$vars = ['data'];
				extract($this->phpbb_dispatcher->trigger_event('chris1278.dsgvo.dsgvo_profile_download', compact($vars)));

				header("Content-type: text/csv");
				header("Content-Disposition: attachment; filename=my_profile_data.csv");
				header("Pragma: no-cache");
				header("Expires: 0");

				foreach ($data as $name => $value)
				{
					if (!empty($value))
					{
						$header[] = $name;
						$content[] = $this->escape($value);
					}
				}

				echo implode(', ', $header) . "\n";
				echo implode(', ', $content);
				exit;

				redirect(append_sid("{$this->phpbb_root_path}ucp.{$this->php_ext}"));
		}
	}

	public function dsgvo_posts_download ($event)
	{
		switch ($event['mode'])
		{
			case 'data_download':
				$this->template->assign_vars([
					'U_DSGVO_POSTS_DOWNLOAD'		=> $this->auth->acl_get('u_dsgvo_posts_download') ? append_sid("{$this->phpbb_root_path}ucp.$this->php_ext", 'mode=u_dsgvo_posts_download') : '',
					]);
				break;

			case 'u_dsgvo_posts_download':
				header("Content-type: text/csv");
				header("Content-Disposition: attachment; filename=my_post_data.csv");
				header("Pragma: no-cache");
				header("Expires: 0");

				$fields = 'post_id, topic_id, forum_id, poster_ip, post_time, post_subject';
				if ($this->config['dsgvo_post_format'])
				{
					$fields .= ', post_text';
				}

				echo $fields . "\n";

				$sql_and = '';

				if ($this->config['dsgvo_post_read'])
				{
					$forum_ids = array_keys($this->auth->acl_getf('f_read', true));
					$sql_and .= ' AND ' . $this->db->sql_in_set('forum_id', $forum_ids);
				}

				$post_visibility = [ITEM_APPROVED];

				if ($this->config['dsgvo_post_unapproved'])
				{
					$post_visibility[] =  ITEM_UNAPPROVED;
					$post_visibility[] =  ITEM_REAPPROVE;
				}

				if ($this->config['dsgvo_post_deleted'])
				{
					$post_visibility[] =  ITEM_DELETED;
				}

				$sql_and .= ' AND ' . $this->db->sql_in_set('post_visibility', $post_visibility);

				$sql = 'SELECT ' . $fields . '
					FROM ' .  POSTS_TABLE . '
					WHERE poster_id = ' . (int) $this->user->data['user_id'] .
					$sql_and;
				$result = $this->db->sql_query($sql);
				while ($row = $this->db->sql_fetchrow($result))
				{
					if ($this->config['dsgvo_post_format'])
					{
						$row['post_text'] = $this->escape($row['post_text']);
					}
					$row['post_subject'] = $this->escape($row['post_subject']);
					$row['post_time'] = '"' . $this->user->format_date($row['post_time']) . '"';
					echo implode(', ', $row) . "\n";
				}
				exit;

				redirect(append_sid("{$this->phpbb_root_path}ucp.{$this->php_ext}"));
		}

		$this->template->assign_vars([
		'FORMAT_OF_POST'			=>	$this->config['dsgvo_post_format'],
		]);
	}

	private function escape($data)
	{
		if (substr_count($data, '"'))
		{
			$data = str_replace('"', '""', $data);
		}
		return '"' . $data . '"';
	}
}
