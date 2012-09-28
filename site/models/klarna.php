<?php
/**
 * Description of Adress Model
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
 * This file is part of adress.
 * 
 * Adress Model is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * Adress Model is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with Adress Model.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
require_once JPATH_COMPONENT.DS.'helpers'.DS.'KlarnaHelper.php';
KlarnaHelper::loadClasses();
KlarnaHelper::loadTransportClasses();
 
class PayhubModelKlarna extends JModelItem
{
	/**
	 * @var string msg
	 */
	protected $msg;
        
        /**
         *
         * @var class Klarna
         */
        protected $Klarna;
 
        public function __construct($config = array()) {
            parent::__construct($config);
            if (!isset($this->Klarna)){
                $this->Klarna = new Klarna();
            }
            $this->Klarna->config(
                2552,               // Merchant ID
                'g8wTG5uh7LKaqLl',       // Shared Secret
                KlarnaCountry::SE,    // Country
                KlarnaLanguage::SV,   // Language
                KlarnaCurrency::SEK,  // Currency
                Klarna::BETA,         // Server
                'json',               // PClass Storage
                '/srv/pclasses.json', // PClass Storage URI path
                true,                 // SSL
                true                  // Remote logging of response times of xmlrpc calls
            );
            $this->Klarna->setCountry('se');
        }
	/**
	 * Get the Adress
	 * @return string The message to be displayed to the user
	 */
	public function getAdress($personNummer) {
            try {
                $address = $this->Klarna->getAddresses($personNummer);
                return $address;
            }catch(Exception $e){
                JFactory::getApplication()->enqueueMessage( $e->getMessage().' (#'.$e->getCode().')', 'error');
                return;
            }
	}
        
        public function addTransaction($articles){
            
        }
}