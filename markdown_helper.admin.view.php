<?php
/**
 * @class  markdown_helperAdminView
 * @author rzglitch
 * @brief  Admin view class of the Markdown Helper module
 */

class markdown_helperAdminView extends markdown_helper {
	function init()
	{
		$this->setTemplatePath($this->module_path.'tpl');
		$this->setTemplateFile(strtolower(str_replace('dispMarkdown_helperAdmin', '', $this->act)));
	}

	function dispMarkdown_helperAdminConfig()
	{
		$oMarkdown_helperAdminModel = getAdminModel('markdown_helper');
		$css_files = $oMarkdown_helperAdminModel->getCssFiles();

		$oMarkdown_helperModel = getModel('markdown_helper');
		$loaded_css_file = $oMarkdown_helperModel->getConfig('css_file_name');

		Context::set('css_file_list', $css_files);
		Context::set('loaded_css_file', $loaded_css_file . '.css');
	}
}
