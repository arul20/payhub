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
require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'CryptHelper.php';
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
        }
        
        public function getSettings(){
            $db =& JFactory::getDbo();
            $table = $db->nameQuote('#__payhub_klarna_settings');
            $query = "SELECT * FROM ".$table;
            $db->setQuery($query);
            $settings = $db->loadObject();
            return $settings;
        }
        
        public function getActiveFees(){
            $db =& JFactory::getDbo();
            $published = $db->nameQuote('published');
            $table = $db->nameQuote('#__payhub_fees');
            $query = "SELECT * FROM ".$table." WHERE ".$published." = 1";
            $db->setQuery($query);
            $fees = $db->loadObjectList();
            return $fees;
        }
        
	/**
	 * Get the Adress
	 * @return string The message to be displayed to the user
	 */
	public function getAdress($personNummer) {
            try {
                $addresses = $this->Klarna->getAddresses($personNummer);
                return $addresses[0]->toArray();
            }catch(Exception $e){
                JFactory::getApplication()->enqueueMessage( $e->getMessage().' (#'.$e->getCode().')', 'error');
                return;
            }
	}
        
        public function setConfig($settings){
            $this->Klarna->config(
                $settings->mid,               // Merchant ID
                CryptHelper::decrypt($settings->shared_secret),       // Shared Secret
                $settings->country,    // Country
                $settings->language,   // Language
                $settings->currency,  // Currency
                $settings->beta_mode,         // Server
                'json',               // PClass Storage
                '/srv/pclasses.json', // PClass Storage URI path
                $settings->ssl_mode,                 // SSL
                true                  // Remote logging of response times of xmlrpc calls
            );
            $this->Klarna->setCountry('se');
        }
        
        public function addFees($fees){
            foreach ($fees as $fee) {
                $this->Klarna->addArticle(
                    1,                      // Quantity
                    $fee->sku,             // Article number
                    $fee->title,      // Article name/title
                    $fee->price,                 // Price
                    $fee->vat,                     // 25% VAT
                    0,                      // Discount
                    KlarnaFlags::INC_VAT    // Price is including VAT.
                );
            }
        }
        
        public function setAdress(){
            $addr = new KlarnaAddr(
                'always_approved@klarna.com', // email
                '',                           // Telno, only one phone number is needed.
                '0762560000',                 // Cellno
                'Testperson-se',              // Firstname
                'Approved',                   // Lastname
                '',                           // No care of, C/O.
                'St�rgatan 1',                // Street
                '12345',                      // Zip Code
                'Ankeborg',                   // City
                KlarnaCountry::SE,            // Country
                null,                         // HouseNo for German and Dutch customers.
                null                          // House Extension. Dutch customers only.
            );
            $this->Klarna->setAddress(KlarnaFlags::IS_BILLING, $addr);  // Billing / invoice address
            $this->Klarna->setAddress(KlarnaFlags::IS_SHIPPING, $addr); // Shipping / delivery address
        }
        
        public function addTransaction($articles=null){
            $this->Klarna->addArticle(
                4,                      // Quantity
                "MG200MMS",             // Article number
                "Matrox G200 MMS",      // Article name/title
                299.99,                 // Price
                25,                     // 25% VAT
                0,                      // Discount
                KlarnaFlags::INC_VAT    // Price is including VAT.
            );

            $this->Klarna->setEstoreInfo(
                '175012',       // Order ID 1
                '1999110234',   // Order ID 2
                ''              // Optional username, email or identifier
            );
            $this->Klarna->setComment('A text string stored in the invoice commentary area.');
            /** Shipment type **/
            // Normal shipment is defaulted, delays the start of invoice expiration/due-date.
            $this->Klarna->setShipmentInfo('delay_adjust', KlarnaFlags::EXPRESS_SHIPMENT);
            try {
            // Transmit all the specified data, from the steps above, to Klarna.
            $result = $this->Klarna->addTransaction(
                '4103219202',             // PNO (Date of birth for DE and NL).
                null,                   // Gender.
                KlarnaFlags::NO_FLAG,   // Flags to affect behavior.
                // -1, notes that this is an invoice purchase, for part payment purchase
                // you will have a pclass object on which you use getId().
                KlarnaPClass::INVOICE
            );
            // Check the order status
            if ($result[1] == KlarnaFlags::PENDING) {
                /* The order is under manual review and will be accepted or denied at a
                later stage. Use cronjob with checkOrderStatus() or visit Klarna
                Online to check to see if the status has changed. You should still
                show it to the customer as it was accepted, to avoid further attempts
                to fraud.
                */
            }
            // Here we get the invoice number
            $invno = $result[0];
            // Order is complete, store it in a database.
            echo "Status: {$result[1]}\nInvno: {$result[0]}\n";
            } catch(Exception $e) {
                // The purchase was denied or something went wrong, print the message:
                echo "{$e->getMessage()} (#{$e->getCode()})\n";
                echo $e->getTraceAsString();
            }
        }
}