<?php
/**
 * @class  markdown_helperAdminModel
 * @author rzglitch
 * @brief  admin model class of the Markdown Helper module
 */

class markdown_helperAdminModel extends markdown_helper {
	function init() {

	}

	function getCssFiles()
	{
		$path = \RX_BASEDIR . 'modules/markdown_helper/css';

		$handle  = opendir($path);
		$files = array();

		while (false !== ($filename = readdir($handle)))
		{
			if($filename == "." || $filename == "..")
			{  
				continue;
			}

			if(is_file($path . "/" . $filename))
			{
				$files[] = $filename;
			}
		}

		closedir($handle);
		sort($files);

		return $files;
	}
}
