<?php
/**
 * @class  markdown_helper
 * @author rzglitch
 * @brief  Main class of the Markdown Helper module
 */

class markdown_helper extends ModuleObject
{
	private $triggers = null;

	private $fixed_triggers = array(
		array('display', 'markdown_helper', 'controller', 'triggerBeforeDisplay', 'before')
	);

	/**
	 * @brief Install module
	 */
	function moduleInstall()
	{
		$oModuleModel = getModel('module');
		$oModuleController = getController('module');

		$oMarkdown_helperModel = getModel('markdown_helper');
		$this->triggers = $oMarkdown_helperModel->getConfig('triggers');

		foreach ($this->triggers as $trigger)
		{
			$oModuleController->insertTrigger($trigger[0], $trigger[1], $trigger[2], $trigger[3], $trigger[4]);
		}

		foreach ($this->fixed_triggers as $trigger)
		{
			$oModuleController->insertTrigger($trigger[0], $trigger[1], $trigger[2], $trigger[3], $trigger[4]);
		}

		return new BaseObject();
	}

	/**
	 * @brief Check update
	 */
	function checkUpdate()
	{
		$helper = '/markdown_helper/config.json';
		$origin = \RX_BASEDIR . 'modules' . $helper;
		$path = \RX_BASEDIR . 'files' . $helper;

		if (!Rhymix\Framework\Storage::isFile($path))
		{
			Rhymix\Framework\Storage::copy($origin.'.example', $path);
		}

		$oModuleModel = getModel('module');

		$oMarkdown_helperModel = getModel('markdown_helper');
		$this->triggers = $oMarkdown_helperModel->getConfig('triggers');

		foreach ($this->triggers as $trigger)
		{
			if (!$oModuleModel->getTrigger($trigger[0], $trigger[1], $trigger[2], $trigger[3], $trigger[4]))
			{
				return true;
			}
		}

		foreach ($this->fixed_triggers as $trigger)
		{
			if (!$oModuleModel->getTrigger($trigger[0], $trigger[1], $trigger[2], $trigger[3], $trigger[4]))
			{
				return true;
			}
		}

		return false;
	}

	/**
	 * @brief Module update
	 */
	function moduleUpdate()
	{
		$oModuleModel = getModel('module');
		$oModuleController = getController('module');

		$oMarkdown_helperModel = getModel('markdown_helper');
		$this->triggers = $oMarkdown_helperModel->getConfig('triggers');

		foreach ($this->triggers as $trigger)
		{
			if (!$oModuleModel->getTrigger($trigger[0], $trigger[1], $trigger[2], $trigger[3], $trigger[4]))
			{
				$oModuleController->insertTrigger($trigger[0], $trigger[1], $trigger[2], $trigger[3], $trigger[4]);
			}
		}

		foreach ($this->fixed_triggers as $trigger)
		{
			if (!$oModuleModel->getTrigger($trigger[0], $trigger[1], $trigger[2], $trigger[3], $trigger[4]))
			{
				$oModuleController->insertTrigger($trigger[0], $trigger[1], $trigger[2], $trigger[3], $trigger[4]);
			}
		}

		return new BaseObject(0, 'success_updated');
	}

	/**
	 * @brief Recompile cache
	 */
	function recompileCache()
	{
	}

}
?>
