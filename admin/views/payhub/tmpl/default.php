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
    <div class="cpanel">
        <?php DashboardHelper::addButton(
                '/joomla_svn25/administrator/index.php?option=com_payhub&amp;view=items', 
                '/joomla_svn25/administrator/templates/bluestork/images/header/icon-48-article.png', 
                'View Sellable Items'); 
        ?>
        <?php DashboardHelper::addButton(
                '/joomla_svn25/administrator/index.php?option=com_payhub&amp;view=items&amp;task=add', 
                '/joomla_svn25/administrator/templates/bluestork/images/header/icon-48-article-add.png', 
                'Add Sellable Item'); 
        ?>
        <?php DashboardHelper::addButton(
                '/joomla_svn25/administrator/index.php?option=com_payhub&amp;view=klarna', 
                '/joomla_svn25/administrator/templates/bluestork/images/header/icon-48-cpanel.png', 
                'Add Sellable Item'); 
        ?>
    </div>