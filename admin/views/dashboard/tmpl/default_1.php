<?php
/**
 * Description of PayHub
 *
 * @version  1.0
 * @author Daniel Eliasson Stilero Webdesign http://www.stilero.com
 * @copyright  (C) 2012-sep-27 Stilero Webdesign, Stilero AB
 * @category Plugins
 * @license	GPLv2
 * 
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * 
 * This file is part of default.
 * 
 * PayHub is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * PayHub is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with PayHub.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 
JToolBarHelper::title( JText::_( 'PayHub' ), 'payhub.png' );
?>
<table cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr>
        <td>
            <div id="cpanel">
                <div style="float: left">
                    <div class="icon hasTip" title="<?php echo JText::_('RSEPRO_SUBMENU_EVENTS'); ?>">
                        <a href="<?php echo JRoute::_('index.php?option=com_rseventspro&view=events'); ?>">
                            <?php echo JHTML::_('image', 'administrator/components/com_rseventspro/assets/images/events.png', JText::_('RSEPRO_SUBMENU_EVENTS')); ?>
                            <span><?php echo JText::_('RSEPRO_SUBMENU_EVENTS'); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </td>
    </tr> 
</table>