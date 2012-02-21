<?php
require_once(WCF_DIR.'lib/system/event/EventListener.class.php');

/**
 * @svn			$Id: UserProfileEditFormIRCListener.class.php 699 2010-01-19 18:24:31Z TobiasH87 $
 * 
 * Adds the IRC User data to user profile edit form.
 * 
 * @author		Marc  - http://community.woltlab.com/db/index.php?page=User&userID=13865 , and WCF 1.1 adjustment by TobiasH
 * @package		com.woltlab.community.page.pjIRCChat
 */
class UserProfileEditFormIRCListener implements EventListener {
	protected $ircUsername = '';
	protected $irc2ndUsername = '';
	protected $ircPassword = '';
	protected $ircCommand = '';
	protected $passReplace = '';
	
	/**
	 * @see EventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName) {
		if ($eventObj->activeCategory == 'settings.communication') {
			if ($eventName == 'validate') {
				if (WCF::getUser()->getPermission('user.managepages.canSeepjircchat')) {
					if (isset($_POST['ircUsername'])) $this->ircUsername = StringUtil::trim($_POST['ircUsername']);
					if (isset($_POST['irc2ndUsername'])) $this->irc2ndUsername = StringUtil::trim($_POST['irc2ndUsername']);
					if (isset($_POST['ircPassword'])) $this->ircPassword = StringUtil::trim($_POST['ircPassword']);
					if (isset($_POST['ircCommand'])) $this->ircCommand = StringUtil::trim($_POST['ircCommand']);
					
					// save
					$eventObj->additionalFields['ircUsername'] = $this->ircUsername;
					$eventObj->additionalFields['irc2ndUsername'] = $this->irc2ndUsername;
					
					if($this->ircPassword != "password"){
						$eventObj->additionalFields['ircPassword'] = $this->ircPassword;
					}
					
					$eventObj->additionalFields['ircCommand'] = $this->ircCommand;
				}
				
			}
			else if ($eventName == 'assignVariables') {
				if (!count($_POST)) {
					// get current values
					$this->ircUsername = WCF::getUser()->ircUsername;
					$this->irc2ndUsername = WCF::getUser()->irc2ndUsername;
					$this->ircPassword = WCF::getUser()->ircPassword;
					$this->ircCommand = WCF::getUser()->ircCommand;
					
					if($this->ircPassword != "") {
						$this->passReplace ="password";
					}else{
						$this->passReplace = "";
					}
				}
				
				$fields = array();
				
				// get irc username
				if (WCF::getUser()->getPermission('user.managepages.canSeepjircchat')) {
					$fields[] = array(
						'optionName' => 'ircUsername',
	                       			'beforeLabel' => false,
	                        		'html' => '<input id="ircUsername" type="text" class="inputText" name="ircUsername" value="'.StringUtil::encodeHTML($this->ircUsername).'" />'
	                        	);
					$fields[] = array(
						'optionName' => 'irc2ndUsername',
	                       			'beforeLabel' => false,
	                        		'html' => '<input id="irc2ndUsername" type="text" class="inputText" name="irc2ndUsername" value="'.StringUtil::encodeHTML($this->irc2ndUsername).'" />'
	                        	);
					$fields[] = array(
						'optionName' => 'ircPassword',
	                       			'beforeLabel' => false,
	                        		'html' => '<input id="ircPassword" type="password" class="inputText" name="ircPassword" value="'.StringUtil::encodeHTML($this->passReplace).'" />'
	                        	);
					$fields[] = array(
						'optionName' => 'ircCommand',
	                       			'beforeLabel' => false,
	                        		'html' => '<input id="ircCommand" type="text" class="inputText" name="ircCommand" value="'.StringUtil::encodeHTML($this->ircCommand).'" />'
	                        	);
				}
			
				// add fields
				if (count($fields) > 0) {
					foreach ($eventObj->options as $key => $category) {
						if ($category['categoryName'] == 'profile.irc') {
							$eventObj->options[$key]['options'] = array_merge($category['options'], $fields);
							return;
						}
					}
					
					$eventObj->options[] = array(
						'categoryName' => 'profile.irc',
						'categoryIconM' => RELATIVE_WCF_DIR . 'icon/pjircchatM.png',
						'options' => $fields
					);
				}
			}
		}
	}
}
?>