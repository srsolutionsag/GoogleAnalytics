<?php
 
include_once("./Services/Component/classes/class.ilPluginConfigGUI.php");
 
/**
 * Example user interface plugin
 * 
 * @author Stefan Born <stefan.born@phzh.ch>
 *
 */
class ilGoogleAnalyticsConfigGUI extends ilPluginConfigGUI
{
	/**
	 * Handles all commmands, default is 'configure'
	 *
	 * @access public
	 */
	function performCommand($cmd)
	{		
		switch ($cmd)
		{
			case 'configure':
			case 'save':
				$this->$cmd();
				break;
		}
	}
	
	/**
	 * Configure screen
	 *
	 * @access public
	 */
	public function configure()
	{
		global $tpl, $ilDB;

		$plugin = $this->getPluginObject();
		$form = $this->initConfigurationForm($plugin);
		
		// get binary
		$account_id = $plugin->getAccountId();
		if ($account_id == null)
			ilUtil::sendFailure($plugin->txt("warning_no_account_id"));
		
		// set all plugin settings values
		$val = array();
		$val["account_id"] = $account_id;
		$val["anonymize_ip"] = $plugin->getAnonymizeIp();
		$val["track_downloads"] = $plugin->getTrackDownloads();
		$form->setValuesByArray($val);
		
		$tpl->setContent($form->getHTML());
	}
	
	/**
	 * Save form input
	 *
	 */
	public function save()
	{
		global $tpl, $lng, $ilCtrl, $ilDB;
		
		$plugin = $this->getPluginObject();		
		$form = $this->initConfigurationForm($plugin);
		
		if ($form->checkInput())
		{
			$plugin->setAccountId($_POST["account_id"]);
			$plugin->setAnonymizeIp($_POST["anonymize_ip"]);
			$plugin->setTrackDownloads($_POST["track_downloads"]);

			ilUtil::sendSuccess($lng->txt("saved_successfully"), true);
			$ilCtrl->redirect($this, "configure");
		}
		else
		{
			$form->setValuesByPost();
			$tpl->setContent($form->getHtml());
		}
	}	
	
	/**
	 * Init configuration form.
	 *
	 * @return object form object
	 * @access public
	 */
	private function initConfigurationForm($plugin)
	{
		global $lng, $ilCtrl;
		
		include_once("Services/Form/classes/class.ilPropertyFormGUI.php");
		$form = new ilPropertyFormGUI();
		$form->setTableWidth("100%");
		$form->setTitle($plugin->txt("plugin_configuration"));
		$form->setFormAction($ilCtrl->getFormAction($this));
		
		// account id
		$input = new ilTextInputGUI($plugin->txt("account_id"), "account_id");
		$input->setRequired(true);
		$input->setValue($plugin->getAccountId());
		$input->setInfo($plugin->txt("account_id_info"));
		$form->addItem($input);

		// anonymize ip
		$input = new ilCheckboxInputGUI($plugin->txt("anonymize_ip"), "anonymize_ip");
		$input->setValue("1");
		$input->setChecked($plugin->getAnonymizeIp());
		$input->setInfo($plugin->txt("anonymize_ip_info"));
		$form->addItem($input);

		// track downloads
		$input = new ilCheckboxInputGUI($plugin->txt("track_downloads"), "track_downloads");
		$input->setValue("1");
		$input->setChecked($plugin->getTrackDownloads());
		$input->setInfo($plugin->txt("track_downloads_info"));
		$form->addItem($input);

		$form->addCommandButton("save", $lng->txt("save"));
		
		return $form;
	}
}
 
?>