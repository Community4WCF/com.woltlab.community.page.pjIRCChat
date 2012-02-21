<?php
// wcf imports
require_once(WCF_DIR.'lib/system/event/EventListener.class.php');

/**
 * @svn			$Id: PJIRCChatPageIRCListener.class.php 693 2010-01-19 16:09:04Z TobiasH87 $
 * 
 * Copy the Ident to IRC-Chat.
 * 
 * @author		Marc  - http://community.woltlab.com/db/index.php?page=User&userID=13865 , and WCF 1.1 adjustment by TobiasH
 * @package		com.woltlab.community.page.pjIRCChat
 */
class PJIRCChatPageIRCListener implements EventListener
{
	/**
	 * 
	 * @return	void
	 * @see		EventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName)
	{
			// Copy the Ident to IRC-Chat.
			if(WCF::getUser()->getPermission('user.managepages.canSeepjircchat')) {
				WCF::getTPL()->assign('PJIRCCHAT_IDENT', PJIRCCHAT_IDENT);
			}
	}        
}
?>