<?php
// wcf imports
require_once(WCF_DIR.'lib/page/AbstractPage.class.php');
require_once(WCF_DIR.'lib/page/util/menu/PageMenu.class.php');
require_once(WCF_DIR.'lib/data/message/smiley/Smiley.class.php');
// set active menu item
PageMenu::setActiveMenuItem('wcf.header.menu.pjircchat');

/**
 * @svn			$Id: PJIRCChatPage.class.php 715 2010-01-20 14:21:00Z TobiasH87 $
 * 
 * This class provides default implementations for the Page interface.
 * This includes the call of the default event listeners for a page: construct, readParameters, assignVariables and show.
 *
 * @author		Marc  - http://community.woltlab.com/db/index.php?page=User&userID=13865 , and WCF 1.1 adjustment by TobiasH
 * @package		com.woltlab.community.page.pjIRCChat
 */
class PJIRCChatPage extends AbstractPage {
	/**
	 * Name of the template for the called page.
	 */
	public $templateName = 'pjIRCChat';
	public $defaultSmileys = array();

	
	/**
	 * @see Page::show()
	 */
	public function show() {
		// assign variables
		$this->assignVariables();
		
			// check permission
			if(WCF::getUser()->getPermission('user.managepages.canSeepjircchat')) {
				
				// grab smilies
				if (!MODULE_SMILEY != 1) {
				$smileys = WCF::getCache()->get('smileys', 'smileys');
				$this->defaultSmileys = (isset($smileys[0]) ? $smileys[0] : array());
				}
		
				//replace special characters in nickname  
				$checkedname = WCF::getUser()->username;
				$checkedname = str_replace(PJIRCCHAT_REGEX, "", $checkedname);
				$checkedname = str_replace(" ", "_", $checkedname);
							
				WCF::getTPL()->assign('PJIRCCHAT_CHECKEDNAME', $checkedname);
				WCF::getTPL()->assign('PJIRCCHAT_LOGONNAME', PJIRCCHAT_LOGONNAME);
				WCF::getTPL()->assign('PJIRCCHAT_HOST', PJIRCCHAT_HOST);
				WCF::getTPL()->assign('PJIRCCHAT_PORT', PJIRCCHAT_PORT);
				WCF::getTPL()->assign('PJIRCCHAT_QUITMESSAGE', PJIRCCHAT_QUITMESSAGE);
				WCF::getTPL()->assign('PJIRCCHAT_CHANNELNAME', PJIRCCHAT_CHANNELNAME);
				WCF::getTPL()->assign('PJIRCCHAT_WIDTH', PJIRCCHAT_WIDTH);
				WCF::getTPL()->assign('PJIRCCHAT_HEIGHT', PJIRCCHAT_HEIGHT);
				WCF::getTPL()->assign('PJIRCCHAT_GUESTNAME', PJIRCCHAT_GUESTNAME);
				WCF::getTPL()->assign('PJIRCCHAT_ADVANCED', PJIRCCHAT_ADVANCED);
				WCF::getTPL()->assign('PJIRCCHAT_ONLINE', PJIRCCHAT_ONLINE);
				WCF::getTPL()->assign('PJIRCCHAT_XTRAMSG', PJIRCCHAT_XTRAMSG);
				WCF::getTPL()->assign('smileys', $this->defaultSmileys);
			
			}else{
				require_once(WCF_DIR.'lib/system/exception/PermissionDeniedException.class.php');
				throw new PermissionDeniedException();
			}
		
		// call show event
		EventHandler::fireAction($this, 'show');

		// show template
		if (!empty($this->templateName)) {
			WCF::getTPL()->display($this->templateName);
		}
	}
}
?>