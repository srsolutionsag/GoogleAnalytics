<?php

include_once("./Services/UIComponent/classes/class.ilUserInterfaceHookPlugin.php");

/**
 * Example user interface plugin
 *
 * @author Stefan Born <stefan.born@phzh.ch>
 *
 */
class ilGoogleAnalyticsPlugin extends ilUserInterfaceHookPlugin {

	/**
	 * @var ilSetting
	 */
	private $settings = NULL;
	private $account_id = NULL;
	private $anonymize_ip = false;
	private $track_downloads = false;
	private $use_tag_manager = false;
	private $container_id = NULL;


	/**
	 * Object initialization. Can be overwritten by plugin class
	 * (and should be made protected final)
	 */
	protected function init() {
		$this->settings = new ilSetting("ui_uihk_googa");
		$this->account_id = $this->settings->get("account_id", NULL);
		$this->anonymize_ip = $this->settings->get("anonymize_ip", false) == true;
		$this->track_downloads = $this->settings->get("track_downloads", false) == true;
		$this->use_tag_manager = $this->settings->get("use_tag_manager", false) == true;
        $this->container_id = $this->settings->get("container_id", NULL);
	}


	/**
	 * Gets the name of the plugin.
	 *
	 * @return string The name of the plugin.
	 */
	public function getPluginName() {
		return "GoogleAnalytics";
	}


	/**
	 * After activation processing
	 */
	protected function afterActivation() {
		// save the settings
		$this->setAccountId($this->getAccountId());
		$this->setAnonymizeIp($this->getAnonymizeIp());
		$this->setTrackDownloads($this->getTrackDownloads());
		$this->setUseTagManager($this->getUseTagManager());
        $this->setContainerId($this->getContainerId());
	}


	/**
	 * Sets the google analytics account id.
	 *
	 * @param int $a_value The new value
	 */
	public function setAccountId($a_value) {
		$this->account_id = strlen($a_value) > 0 ? $a_value : NULL;
		$this->settings->set('account_id', $this->account_id);
	}


	/**
	 * Gets the google analytics account id.
	 *
	 * @return int The current value
	 */
	public function getAccountId() {
		return $this->account_id;
	}


	/**
	 * Sets whether IP addresses are anonymized.
	 *
	 * @param int $a_value The new value
	 */
	public function setAnonymizeIp($a_value) {
		$this->anonymize_ip = $a_value == true;
		$this->settings->set('anonymize_ip', $this->anonymize_ip);
	}


	/**
	 * Gets whether IP addresses are anonymized.
	 *
	 * @return int The current value
	 */
	public function getAnonymizeIp() {
		return $this->anonymize_ip;
	}


	/**
	 * Sets whether downloads should be tracked.
	 *
	 * @param int $a_value The new value
	 */
	public function setTrackDownloads($a_value) {
		$this->track_downloads = $a_value == true;
		$this->settings->set('track_downloads', $this->track_downloads);
	}


	/**
	 * Gets whether downloads should be tracked.
	 *
	 * @return int The current value
	 */
	public function getTrackDownloads() {
		return $this->track_downloads;
	}


    /**
     * Sets whether the google tag manager should be used.
     *
     * @param int $a_value The new value
     */
    public function setUseTagManager($a_value) {
        $this->use_tag_manager = $a_value == true;
        $this->settings->set('use_tag_manager', $this->use_tag_manager);
    }


    /**
     * Gets whether the google tag manager should be used.
     *
     * @return int The current value
     */
    public function getUseTagManager() {
        return $this->use_tag_manager;
    }


    /**
     * Sets the google tag manager container id.
     *
     * @param int $a_value The new value
     */
    public function setContainerId($a_value) {
        $this->container_id = strlen($a_value) > 0 ? $a_value : NULL;
        $this->settings->set('container_id', $this->container_id);
    }


    /**
     * Gets the google tag manager container id.
     *
     * @return int The current value
     */
    public function getContainerId() {
        return $this->container_id;
    }
}

?>