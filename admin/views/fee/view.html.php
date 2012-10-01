<?php
/**
 * Description of PayHub
 *
 * @version  1.0
 * @author Daniel Eliasson Stilero Webdesign http://www.stilero.com
 * @copyright  (C) 2012-okt-01 Stilero Webdesign, Stilero AB
 * @category Components
 * @license	GPLv2
 * 
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * 
 * This file is part of view.html.
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

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML View class for the HelloWorld Component
 */
class PayHubViewFee extends JView{
    
    function edit($id) {
        JToolBarHelper::title(JText::_('PayHub Fee: [<small>Edit</small>]', 'generic.png'));
        JToolBarHelper::save();
        JToolBarHelper::cancel('cancel', 'Close');
        $model =& $this->getModel();
        $fee = $model->getFee( $id );
        $this->assignRef('fee', $fee);
        parent::display();
    }
    
    function add(){
        JToolBarHelper::title( JText::_('PayHub Fee')
                . ': [<small>Add</small>]' );
        JToolBarHelper::save();
        JToolBarHelper::cancel();
        $model =& $this->getModel();
        $fee = $model->getNewFee();
        $this->assignRef('fee', $fee);
        parent::display();
    }
}
