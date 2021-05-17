<?php
/**
 * @class  markdown_helperModel
 * @author rzglitch
 * @brief  Model class of the Markdown Helper module
 */

class markdown_helperModel extends markdown_helper {
	function init() {

	}

	function getConfig($k)
	{
		$path = \RX_BASEDIR . 'files/markdown_helper/config.json';

		if (!Rhymix\Framework\Storage::isFile($path)) return null;

		$file = Rhymix\Framework\Storage::read($path);
		$data = json_decode($file, true);

		if (array_key_exists($k, $data)) 
		{
			return $data[$k];
		}
		else
		{
			return null;
		}
	}

	function getTargetSrl(&$obj)
	{
		$config = $this->getConfig('srls');
		$config = array_reverse($config);

		$srl = null;

		foreach ($config as $v) {
			if (property_exists($obj, $v) && $srl === null)
			{
				$srl = $v;
			}
		}

		return $srl;
	}

	function getMarkdownData()
	{
		if(!checkCSRF())
		{
			return new BaseObject(-1, 'msg_security_violation');
		}

		$srl = (integer) Context::get('target_srl');

		$args = new stdClass();

		$args->target_srl = $srl;
		$query = executeQuery('markdown_helper.getDocument', $args);
		$data = $query->data;

		if ($data->target_srl)
		{
			$args->content = $data->content;

			$this->add('target_srl', $srl);
			$this->add('content', $args->content);
		}
		else
		{
			$this->add('target_srl', $srl);
			$this->add('content', null);
		}
	}
}
