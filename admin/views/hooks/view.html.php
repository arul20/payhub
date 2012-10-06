<?php
/**
 * Description of PayHub
 *
 * @version  1.0
 * @author Daniel Eliasson Stilero Webdesign http://www.stilero.com
 * @copyright  (C) 2012-okt-06 Stilero Webdesign, Stilero AB
 * @category Components
 * @license	GPLv2
 * 
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * 
 * This file is part of hooks.
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
require_once JPATH_COMPONENT.DS.'helpers'.DS.'PayhubHelper.php'; 
require_once JPATH_COMPONENT.DS.'helpers'.DS.'AdminListHelper.php'; 

/**
 * HTML View class for the HelloWorld Component
 */
class PayHubViewHooks extends JView{
    
    function display($tpl = null) {
        JToolBarHelper::title(JText::_('PayHub Hooks', 'generic.png'));
        JToolBarHelper::deleteList();
        JToolBarHelper::editListX();
        JToolBarHelper::addNewX();
        $model =& $this->getModel('hooks');
        $items =& $model->getItems();
        $this->assignRef('items', $items);
        parent::display($tpl);
    }
    
    function edit($id) {
        JToolBarHelper::title(JText::_('PayHub Hooks: [<small>Edit</small>]', 'generic.png'));
        JToolBarHelper::save();
        JToolBarHelper::cancel('cancel', 'Close');
        //$layout = $this->getLayout('form');
        $model =& $this->getModel();
        $paymentModel =& $this->getModel('payments');
        $payments = $paymentModel->getItems();
        $actionModel =& $this->getModel('actions');
        $actions = $actionModel->getItems();
        $extensions = $actionModel->getExtensions();
        $item = $model->getItem( $id );
        $this->assignRef('item', $item);
        $this->assignRef('payments', $payments);
        $this->assignRef('actions', $actions);
        $this->assignRef('extensions', $extensions);
        parent::display();
    }
    
    function add(){
        JToolBarHelper::title( JText::_('PayHub Hooks')
                . ': [<small>Add</small>]' );
        JToolBarHelper::save();
        JToolBarHelper::cancel();
        $model =& $this->getModel();
        $item = $model->getNewItem();
        $paymentModel =& $this->getModel('payments');
        //$paymentModel =& JModel::getInstance("payments","PayhubModel");
        $payments = $paymentModel->getItems();
        $actionModel =& $this->getModel('actions');
        $actions = $actionModel->getItems();
        $extensions = $actionModel->getExtensions();
        $this->assignRef('item', $item);
        $this->assignRef('payments', $payments);
        $this->assignRef('actions', $actions);
        $this->assignRef('extensions', $extensions);
        parent::display();
    }
}
