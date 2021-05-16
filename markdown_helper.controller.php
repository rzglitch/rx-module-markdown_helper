<?php
/**
 * @class  markdown_helperController
 * @author rzglitch
 * @brief  Controller class of the Markdown Helper module
 */

class markdown_helperController extends markdown_helper {
	function setConfig($key, $value)
	{
		$oMarkdown_helperModel = getModel('markdown_helper');
		$original_config = $oMarkdown_helperModel->getConfig($key);

		$path = \RX_BASEDIR . 'files/markdown_helper/config.json';

		if (!Rhymix\Framework\Storage::isFile($path)) return null;

		$file = Rhymix\Framework\Storage::read($path);
		$data = json_decode($file, true);

		if (!$value)
		{
			unset($data[$key]);
		}
		else
		{
			$data[$key] = $value;
		}

		$data = json_encode($data);

		return Rhymix\Framework\Storage::write($path, $data);
	}

	function triggerDeleteMarkdown(&$obj)
	{
		$args = new stdClass();

		$oMarkdown_helperModel = getModel('markdown_helper');
		$find_var = $oMarkdown_helperModel->getSrls();

		$args->target_srl = $obj->$find_var;

		$query = executeQuery('markdown_helper.getDocument', $args);
		$data = $query->data;

		if ($data->target_srl) {
			$oDB = DB::getInstance();
			$oDB->begin();

			$output = executeQuery('markdown_helper.deleteDocument', $args);

			$oDB->commit();
		}

		return;
	}

	function triggerInsertMarkdown(&$obj)
	{
		$args = new stdClass();

		$oMarkdown_helperModel = getModel('markdown_helper');
		$find_var = $oMarkdown_helperModel->getSrls();

		$args->target_srl = $obj->$find_var;

		$query = executeQuery('markdown_helper.getDocument', $args);
		$data = $query->data;

		$args->content = Context::get('markdown_content');

		if (!$data->target_srl) {
			$args->m_helper_srl = getNextSequence();

			$oDB = DB::getInstance();
			$oDB->begin();

			$output = executeQuery('markdown_helper.insertDocument', $args);

			$oDB->commit();
		} else {
			$oDB = DB::getInstance();
			$oDB->begin();

			$output = executeQuery('markdown_helper.updateDocument', $args);

			$oDB->commit();
		}

		return;
	}

	function triggerUpdateMarkdown(&$obj)
	{
		return $this->triggerInsertMarkdown($obj);
	}

	function triggerBeforeDisplay()
	{
		$oMarkdown_helperModel = getModel('markdown_helper');
		$css_file = $oMarkdown_helperModel->getConfig('css_file_name');

		if ($css_file && $css_file != 'none')
		{
			Context::addCssFile(\RX_BASEDIR . 'modules/markdown_helper/css/'.$css_file.'.css');
		}
	}
}
