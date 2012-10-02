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
            $this->setConfig();
        }
        
        public function getSettings(){
            $db =& JFactory::getDbo();
            $table = $db->nameQuote('#__payhub_klarna_settings');
            $query = "SELECT * FROM ".$table;
            $db->setQuery($query);
            $settings = $db->loadObject();
            return $settings;
        }
        
        public function getBillableItem($id){
            $db =& JFactory::getDbo();
            $table = $db->nameQuote('#__payhub_items');
            $idKey = $db->nameQuote('id');
            $idVal = $db->Quote($id);
            $query = "SELECT * FROM ".$table." WHERE ".$idKey."=".$idVal;
            $db->setQuery($query);
            $item = $db->loadObject();
            if($item === null){
                JError::raiseError(500, 'Item '.$id.' Not found');
            }else{
                return $item;
            }
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
        
        public function setConfig(){
            $settings = $this->getSettings();
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
        
        public function setAdress($KlarnaAddr){
            $this->Klarna->setAddress(KlarnaFlags::IS_BILLING, $KlarnaAddr);  // Billing / invoice address
            $this->Klarna->setAddress(KlarnaFlags::IS_SHIPPING, $KlarnaAddr); // Shipping / delivery address
        }
        
        public function addTransaction($itemId, $persNr){
            $item = $this->getBillableItem($itemId);
            $this->Klarna->addArticle(
                1,                      // Quantity
                $item->sku,             // Article number
                $item->title,      // Article name/title
                $item->price,                 // Price
                $item->vat,                     // 25% VAT
                0,                      // Discount
                KlarnaFlags::INC_VAT    // Price is including VAT.
            );

            $this->Klarna->setEstoreInfo(
                '175012',       // Order ID 1
                '1999110234',   // Order ID 2
                ''              // Optional username, email or identifier
            );
            //$this->Klarna->setComment('A text string stored in the invoice commentary area.');
            /** Shipment type **/
            // Normal shipment is defaulted, delays the start of invoice expiration/due-date.
            $this->Klarna->setShipmentInfo('delay_adjust', KlarnaFlags::EXPRESS_SHIPMENT);
            try {
            // Transmit all the specified data, from the steps above, to Klarna.
            $result = $this->Klarna->addTransaction(
                $persNr,             // PNO (Date of birth for DE and NL).
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
            $this->logTransaction($result[0], $result[1], $itemId);
            echo "Status: {$result[1]}\nInvno: {$result[0]}\n";
            } catch(Exception $e) {
                // The purchase was denied or something went wrong, print the message:
                $this->logTransaction('', $e->getCode(), $itemId);
                echo "{$e->getMessage()} (#{$e->getCode()})\n";
                //echo $e->getTraceAsString();
            }
        }
        
        public function logTransaction($txnId, $status, $item){
            $db =& JFactory::getDbo();
            $id = $db->nameQuote('id');
            $transId = $db->nameQuote('txn_id');
            $payment_status = $db->nameQuote('payment_status');
            $payment_date = $db->nameQuote('payment_date');
            $first_name = $db->nameQuote('first_name');
            $last_name = $db->nameQuote('last_name');
            $payer_email = $db->nameQuote('payer_email');
            $residence_country = $db->nameQuote('residence_country');
            $item_name = $db->nameQuote('item_name');
            $item_number = $db->nameQuote('item_number');
            $mc_gross = $db->nameQuote('mc_gross');
            $tax = $db->nameQuote('tax');
            $table = $db->nameQuote('#__payhub_transactions');
            $txnVal = $db->Quote($txnId);
            $statusVal = $db->Quote($status);
            jimport('joomla.utilities.date');
            $date = new JDate();
            $txnDate = $db->Quote($date->toMySQL());
            $fName = $db->Quote( JRequest::getVar('inputFName') );
            $eName = $db->Quote( JRequest::getVar('inputEName'));
            $email = $db->Quote( JRequest::getVar('inputEmail'));
            $billableItem = $this->getBillableItem($item);
            $country = $db->Quote('SE');
            $itmName = $db->Quote($billableItem->title);
            $itmSKU = $db->Quote($billableItem->sku);
            $itmPrice = $db->Quote($billableItem->price);
            $itmTax = $db->Quote($billableItem->vat);
            $query = 'INSERT INTO '.$table.'('.
                    $id.','.
                    $transId.','.
                    $payment_status.','.
                    $payment_date.','.
                    $first_name.','.
                    $last_name.','.
                    $payer_email.','.
                    $residence_country.','.
                    $item_name.','.
                    $item_number.','.
                    $mc_gross.','.
                    $tax.
                    ') VALUES ('.
                    'NULL'.','.
                    $txnVal.','.
                    $statusVal.','.
                    $txnDate.','.
                    $fName.','.
                    $eName.','.
                    $email.','.
                    $country.','.
                    $itmName.','.
                    $itmSKU.','.
                    $itmPrice.','.
                    $itmTax.
                    ');';
            $db->setQuery($query);
            if( !$db->query() ){
                $errorMsg = $this->getDBO()->getErrorMsg();
                JError::raiseError(500, 'Error Logging Transaction: '.$errorMsg);
            }
        }
}