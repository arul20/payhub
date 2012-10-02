<?php
/**
 * Description of KlarnaHelper
 *
 * @version  1.0
 * @author Daniel Eliasson Stilero Webdesign http://www.stilero.com
 * @copyright  (C) 2012-sep-28 Stilero Webdesign, Stilero AB
 * @category Plugins
 * @license	GPLv2
 * 
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * 
 * This file is part of KlarnaHelper.
 * 
 * KlarnaHelper is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * KlarnaHelper is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with KlarnaHelper.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 

class KlarnaHelper{
    
    public static function loadClasses(){
        if(!defined('PATH_PAYMENTAPI')){
            define('PATH_PAYMENTAPI', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_payhub'.DS.'classes'.DS.'paymentapis'.DS.'klarna'.DS);
        }
        require_once PATH_PAYMENTAPI.'Country.php';
        require_once PATH_PAYMENTAPI.'Currency.php';
        require_once PATH_PAYMENTAPI.'Encoding.php';
        require_once PATH_PAYMENTAPI.'Exceptions.php';
        require_once PATH_PAYMENTAPI.'Flags.php';
        require_once PATH_PAYMENTAPI.'Language.php';
        require_once PATH_PAYMENTAPI.'Klarna.php';
        require_once PATH_PAYMENTAPI.'klarnaaddr.php';
        require_once PATH_PAYMENTAPI.'klarnacalc.php';
        require_once PATH_PAYMENTAPI.'klarnaconfig.php';
        require_once PATH_PAYMENTAPI.'klarnapclass.php';
    }
    
    public static function loadTransportClasses(){
        require_once PATH_PAYMENTAPI.'transport'.DS.'xmlrpc-3.0.0.beta'.DS.'lib'.DS.'xmlrpc.inc';
        require_once PATH_PAYMENTAPI.'transport'.DS.'xmlrpc-3.0.0.beta'.DS.'lib'.DS.'xmlrpc_wrappers.inc';
    }
    
}
