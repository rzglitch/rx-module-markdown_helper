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
		$css_file = preg_replace('[^a-zA-Z0-9_-$]', '', $css_file);

		$oMarkdown_helperController = getController('markdown_helper');
		$ret = $oMarkdown_helperController->setConfig('css_file_name', $css_file);

		return new BaseObject(-1, 'success_updated');
	}
}
