<?php
/**
 * Description of Klarnawebmail.binero.se
 * we View
 *
 * @version  1.0
 * @author Daniel Eliasson Stilero Webdesign http://www.stilero.com
 * @copyright  (C) 2012-sep-28 Stilero Webdesign, Stilero AB
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
 * Klarna View is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * Klarna View is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with Klarna View.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML View class for the HelloWorld Component
 */
class PayhubViewKlarna extends JView
{
	// Overwriting JView display method
	function display($tpl = null) 
	{
            require_once JPATH_COMPONENT.DS.'helpers'.DS.'PayhubHelper.php';
            $task = JRequest::getCmd('task');
            if($task == 'processPayment'){
                $this->processPayment();
            }else{
                $this->getAdress();
            }
            
            // Display the view
            parent::display($tpl);
	}
        
        function processPayment($tpl = null){
            require_once JPATH_COMPONENT.DS.'helpers'.DS.'PayhubHelper.php';
            $model =& $this->getModel();
            $fees = $model->getActiveFees();
            $settings = $model->getSettings();
            $model->setConfig($settings);
            $model->setAdress();
            $model->addFees($fees);
            $model->addTransaction();
            parent::display($tpl);
        }
        
        function getAdress(){
            $model =& $this->getModel();
            $adresses = $model->getAdress('410321-9202');
            $this->adresses = $adresses;  
        }
}
