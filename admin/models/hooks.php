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
 
// import Joomla modelitem library
jimport('joomla.application.component.model');
 
class PayHubModelHooks extends JModel{
    protected $_items;
    private $_table;
    static private $_tableName = '#__payhub_hooks';

    public function __construct() {
        parent::__construct();
        $db =& JFactory::getDbo();
        $this->_table = $db->nameQuote(self::$_tableName);
    }
    public function getItems(){
        //SELECT 
        //`hooks`.`id`,
        //`pnq93_payhub_actions`.`title` AS `action`,
        //`pnq93_payhub_payments`.`title` AS `payment`
        //FROM 
        //`pnq93_payhub_hooks` AS `hooks`
        //INNER JOIN
        //`pnq93_payhub_actions`
        //ON
        //`pnq93_payhub_actions`.`id` = `hooks`.`action_id`
        //INNER JOIN
        //`pnq93_payhub_payments`
        //ON
        //`pnq93_payhub_payments`.`id` = `hooks`.`payment_id`
                
        $db =& JFactory::getDbo();
        $payTable = $db->nameQuote('#__payhub_payments');
        $actTable = $db->nameQuote('#__payhub_actions');
        $titleKey = $db->nameQuote('title');
        $idKey = $db->nameQuote('id');
        $payIdKey = $db->nameQuote('payment_id');
        $actIdKey = $db->nameQuote('action_id');
        $actionKey = $db->nameQuote('action');
        $payKey = $db->nameQuote('payment');
        $query = "SELECT ".$this->_table.".".$idKey.", ".
                $payTable.".".$titleKey." AS ".$payKey.", ".
                $actTable.".".$titleKey." AS ".$actionKey.
                " FROM ".
                $this->_table.
                " INNER JOIN ".
                $actTable.
                " ON ".$actTable.".".$idKey." = ".  $this->_table.".".$actIdKey.
                " INNER JOIN ".
                $payTable.
                " ON ".$payTable.".".$idKey." = ".  $this->_table.".".$payIdKey;
        //var_dump($query);exit;
                
        $db->setQuery($query);
        $this->_items = $db->loadObjectList();
        return $this->_items;
    }

    public function getItem($id){
        $db =& JFactory::getDbo();
        $key = $db->nameQuote('id');
        $query = "SELECT * FROM ".$this->_table.
                " WHERE ".$key." = ".$id;
        $db->setQuery($query);
        $item = $db->loadObject();
        if($item === null){
            JError::raiseError(500, 'Item '.$id.' Not found');
        }else{
            return $item;
        }
    }
    
    function getNewItem(){
        $newItem =& $this->getTable( 'hooks' );
        $newItem->id = 0;
        return $newItem;
    }
    
    public function store(){
        $table =& $this->getTable();
        $data = JRequest::get('post');
        $table->reset();
        if(!$table->bind($data)){
            $this->setError($this->_db->getErrorMsg());
            return false;
        }
        if(!$table->check()){
            $this->setError($this->_db->getErrorMsg());
            return false;
        }
        if(!$table->store()){
            $this->setError($this->_db->getErrorMsg());
            return false;
        }
        return true;
    }

    public function delete($cids){
        $db =& JFactory::getDbo();
        $id = $db->nameQuote('id');
        $ids = implode(', ', $cids);
        $query = 'DELETE FROM '.$this->_table.
                ' WHERE '.$id.' IN ('.$ids.')';
        $db->setQuery($query);
        if( !$db->query() ){
            $errorMsg = $this->getDBO()->getErrorMsg();
            JError::raiseError(500, 'Error deleting: '.$errorMsg);
        }
    }
    
    public function unpublish($cids){
        $db =& JFactory::getDbo();
        $id = $db->nameQuote('id');
        $published = $db->nameQuote('published');
        $ids = implode(', ', $cids);
        $query = 'UPDATE '.$this->_table.
                ' SET '.$published.' = 0'.
                ' WHERE '.$id.' IN ('.$ids.')';
        $db->setQuery($query);
        if( !$db->query() ){
            $errorMsg = $this->getDBO()->getErrorMsg();
            JError::raiseError(500, 'Error Unpublishing: '.$errorMsg);
        }
    }
    
    public function publish($cids){
        $db =& JFactory::getDbo();
        $id = $db->nameQuote('id');
        $published = $db->nameQuote('published');
        $ids = implode(', ', $cids);
        $query = 'UPDATE '.$this->_table.
                ' SET '.$published.' = 1'.
                ' WHERE '.$id.' IN ('.$ids.')';
        $db->setQuery($query);
        if( !$db->query() ){
            $errorMsg = $this->getDBO()->getErrorMsg();
            JError::raiseError(500, 'Error Unpublishing: '.$errorMsg);
        }
    }
    
    public function performAction($hookId, $orderId){
        $hook = $this->getItem($hookId);
        $sql = $hook->action;
        $query = str_replace('{orderid}', (int)$orderId, $sql);
        $db->setQuery($query);
        if( !$db->query() ){
            $errorMsg = $this->getDBO()->getErrorMsg();
            JError::raiseError(500, 'Error Processing order: '.$errorMsg);
        }
    }
}