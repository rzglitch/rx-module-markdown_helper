<?php
/**
 * @class  markdown_helperAdminController
 * @author rzglitch
 * @brief  Admin controller class of the Markdown Helper module
 */

class markdown_helperAdminController extends markdown_helper {
	function procMarkdown_helperAdminInsertConfig()
	{
		$css_file = Context::get('load_css');
		$css_file = str_replace('.css', '', $css_file);
		$css_file = str_replace('..', '', $css_file);
		$css_file = str_replace('/', '', $css_file);
		$css_file = preg_replace('[^a-zA-Z0-9_\-\.$]', '', $css_file);

		$oMarkdown_helperController = getController('markdown_helper');
		$oMarkdown_helperController->setConfig('css_file_name', $css_file);

		$this->setMessage('success_updated');

		if (Context::get('success_return_url'))
		{
			$this->setRedirectUrl(Context::get('success_return_url'));
		}
		else
		{
			$this->setRedirectUrl(getNotEncodedUrl('', 'module', 'admin', 'act', 'dispMarkdown_helperAdminConfig'));
		}
	}
}
