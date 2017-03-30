<?php
/**
 * @copyright Copyright (c) 2017, Afterlogic Corp.
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program. If not, see <http://www.gnu.org/licenses/>
 */

namespace Aurora\Modules\SimpleChatLoggerPlugin;

/**
 * @package Modules
 */
class Module extends \Aurora\System\Module\AbstractModule
{
	/**
	 * Subscribes on the event that is broadcasted after executing of the CreatePost method in the SimpleChat module.
	 */
	public function init()
	{
		$this->subscribeEvent('SimpleChat::CreatePost::after', array($this, 'afterCreatePost'));
	}
	
	/**
	 * Logs data of the user post in the simple chat.
	 * 
	 * @param array $aArgs Array with data of the user post in the simple chat.
	 *  ['Date'] - string Date and time when user put down the post in UTC.
	 *  ['Text'] - string Text of the user post.
	 */
	public function afterCreatePost($aArgs)
	{
		$iUserId = \Aurora\System\Api::getAuthenticatedUserId();
		\Aurora\System\Api::Log($iUserId.' ['.$aArgs['Date'].'] '.$aArgs['Text'], \ELogLevel::Full, 'simple-chat');
	}
}
