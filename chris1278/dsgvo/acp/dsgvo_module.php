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

class dsgvo_module
{
	protected $config;
	protected $request;
	protected $template;
	protected $language;
	public $u_action;

	public function main()
	{
		global $config,  $request, $template, $language, $phpbb_container;

		$this->config				=	$config;
		$this->request				=	$request;
		$this->template				=	$template;
		$this->language 			=	$language;
		$this->md_manager 			=	$phpbb_container->get('ext.manager')->create_extension_metadata_manager('chris1278/dsgvo');
		$ext_display_name 			=	$this->md_manager->get_metadata('display-name');
		$ext_display_ver 			=	$this->md_manager->get_metadata('version');
		$ext_lang_min_ver 			=	$this->md_manager->get_metadata()['extra']['lang-min-ver'];
		$lang_ver 					=	($this->language->lang('DSGVO_LANG_EXT_VER') !== 'DSGVO_LANG_EXT_VER') ? $this->language->lang('DSGVO_LANG_EXT_VER') : '0.0.0';
		$notes 						=	'';
		$this->tpl_name 			=	'acp_dsgvo_settings';
		$this->page_title			=	$this->language->lang('ACP_DSGVO_TITLE') . ' - ' . $this->language->lang('ACP_DSGVO_SETTINGS');

		add_form_key('chris1278\dsgvo');

		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key('chris1278\dsgvo'))
			{
				trigger_error('FORM_INVALID');
			}
			$this->config->set('dsgvo_post_format', $this->request->variable('dsgvo_post_format', 0));
			$this->config->set('dsgvo_post_read', $this->request->variable('dsgvo_post_read', 0));
			$this->config->set('dsgvo_post_unapproved', $this->request->variable('dsgvo_post_unapproved', 0));
			$this->config->set('dsgvo_post_deleted', $this->request->variable('dsgvo_post_deleted', 0));
			trigger_error($this->language->lang('DSGVO_SAVE') . adm_back_link($this->u_action));
		}

		if (!phpbb_version_compare($lang_ver, $ext_lang_min_ver, '>='))
		{
			$this->add_note($notes, $this->language->lang('DSGVO_MSG_LANGUAGEPACK_OUTDATED'));
		}

		$this->template->assign_vars([
			'U_ACTION'									=>	$this->u_action,
			'DSGVO_POST_FORMAT'							=>	$this->config['dsgvo_post_format'],
			'DSGVO_POST_READ'							=>	$this->config['dsgvo_post_read'],
			'DSGVO_POST_UNAPPROVED'						=>	$this->config['dsgvo_post_unapproved'],
			'DSGVO_POST_DELETED'						=>	$this->config['dsgvo_post_deleted'],
			'DSGVO_EXT_NAME'							=>	$ext_display_name,
			'DSGVO_EXT_VER'								=>	$ext_display_ver,
			'DSGVO_NOTES'								=>	$notes,
		]);
	}

	private function add_note(string &$notes, $msg)
	{
		$notes .= (($notes != '') ? "\n" : "") . sprintf('<p>%s</p>', $msg);
	}

}
