<?php
/**
 * Description of PayPalHelper
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
 * This file is part of PaypalHelper.
 * 
 * PayPalHelper is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * PayPalHelper is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with PayPalHelper.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 

class PaypalHelper{
    public static function loadClasses(){
        define('PATH_PAYMENTAPI', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_payhub'.DS.'classes'.DS.'paymentapis'.DS.'paypal'.DS.'lib'.DS);
        require_once PATH_PAYMENTAPI.'IPPCredential.php';
        require_once PATH_PAYMENTAPI.'exceptions'.DS.'PPConfigurationException.php';
        require_once PATH_PAYMENTAPI.'PPConfigManager.php';
        require_once PATH_PAYMENTAPI.'exceptions'.DS.'PPMissingCredentialException.php';
        require_once PATH_PAYMENTAPI.'PPSignatureCredential.php';
        require_once PATH_PAYMENTAPI.'PPCertificateCredential.php';
        require_once PATH_PAYMENTAPI.'exceptions'.DS.'PPInvalidCredentialException.php';
        require_once PATH_PAYMENTAPI.'PPCredentialManager.php';
        require_once PATH_PAYMENTAPI.'exceptions'.DS.'PPConnectionException.php';
        require_once PATH_PAYMENTAPI.'PPLoggingManager.php';
        require_once PATH_PAYMENTAPI.'PPHttpConnection.php';
        require_once PATH_PAYMENTAPI.'PPConnectionManager.php';
        require_once PATH_PAYMENTAPI.'PPObjectTransformer.php';
        require_once PATH_PAYMENTAPI.'PPUtils.php';
        require_once PATH_PAYMENTAPI.'auth'.DS.'PPAuth.php';
        require_once PATH_PAYMENTAPI.'auth'.DS.'AuthUtil.php';
        require_once PATH_PAYMENTAPI.'PPAuthenticationManager.php';
        require_once(PATH_PAYMENTAPI.'PPAPIService.php');
        require_once(PATH_PAYMENTAPI.'PPBaseService.php');
        require_once(PATH_PAYMENTAPI.'services'.DS.'PayPalAPIInterfaceService'.DS.'PayPalAPIInterfaceService.php');
        require_once(PATH_PAYMENTAPI.'services'.DS.'PayPalAPIInterfaceService'.DS.'PayPalAPIInterfaceServiceService.php');
    }
}
