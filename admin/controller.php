<?php
/**
 * Description of PayHub
 *
 * @version  1.0
 * @author Daniel Eliasson Stilero Webdesign http://www.stilero.com
 * @copyright  (C) 2012-sep-30 Stilero Webdesign, Stilero AB
 * @category Components
 * @license	GPLv2
 * 
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * 
 * This file is part of controller.
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

// import joomla controller library
jimport('joomla.application.component.controller');

class PayHubController extends JController{
    
    public static $modelName = 'items';
    public static $viewName = 'payhub';
    
    public function display(){
        //Set Default View and Model
        $view =& $this->getView( self::$viewName, 'html' );
        //$model =& $this->getModel(  self::$modelName );
        //$view->setModel( $model, true );
        $view->display();
    }
    
//    public function edit(){
//        $cids = JRequest::getVar('cid', null, 'default', 'array');
//        if( $cids === null ){
//            JError::raiseError( 500,
//            'cid parameter missing from the request' );
//        }
//        $itemId = (int)$cids[0];
//        $view =& $this->getView( JRequest::getVar( 'view',  'item' ), 'html' );
//        $model =& $this->getModel( 'item' );
//        $view->setModel( $model, true );
//        $view->edit( $itemId );
//    }
//    
//    function add(){
//        $view =& $this->getView( JRequest::getVar( 'view',  'item' ), 'html' );
//        $model =& $this->getModel( 'item' );
//        $view->setModel( $model, true );
//        $view->add();
//    }
//    
//    function save(){
//        $model =& $this->getModel( 'item' );
//        $model->store();
//        $redirectTo = JRoute::_('index.php?option='.JRequest::getVar('option').'&task=display');
//        $this->setRedirect( $redirectTo, 'Saved' );
//    }
//    
//    function apply(){
//        $model =& $this->getModel( 'item' );
//        $model->store();
//    }
//    
//    function cancel(){
//        $redirectTo = JRoute::_('index.php?option='.JRequest::getVar('option').'&task=display');
//        $this->setRedirect( $redirectTo, 'Cancelled' );
//    }
//    
//    function remove(){
//        $cids = JRequest::getVar('cid', null, 'default', 'array');
//        if( $cids === null ){
//            JError::raiseError( 500, 'Nothing were selected for removal' );
//        }
//        $model =& $this->getModel( self::$modelName);
//        $model->delete( $cids);
//        $redirectTo = JRoute::_('index.php?option='.JRequest::getVar( 'option' ).'&task=display');
//        $this->setRedirect( $redirectTo, 'Deleted' );
//    }
}
