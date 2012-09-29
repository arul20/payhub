<?php
/**
 * Description of Payhub Default View
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
 * This file is part of default.
 * 
 * Payhub Default View is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * Payhub Default View is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with Payhub Default View.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 
//JHTML::_('behavior.formvalidation');

?>
<form method="post" class="form-horizontal" class="form-validate" onSubmit="return myValidate(this);">
    <legend>Fyll i och granska dina uppgifter</legend>
    <?php 
    $user = JFactory::getUser();
    print PayhubHelper::getInputText('Persnr', 'Personnr./Org.Nummer', '&Aring;&Aring;MMDD-NNNN', '410321-9202','medium', FALSE);
    print PayhubHelper::getInputText('Fnamn', 'F&ouml;rnamn', 'F&ouml;rnamn', '','medium', TRUE);
    print PayhubHelper::getInputText('Enamn', 'Efternamn', 'Efternamn', '','medium', TRUE);
    print PayhubHelper::getInputText('Email', 'E-post', 'dinmail@adress.se', $user->email,'medium', FALSE, 'email');
    print PayhubHelper::getInputText('Phone', 'Telefon', '08-1234567');
    print PayhubHelper::getInputText('Mobile', 'Mobiltelefon', '070-123456');
    print PayhubHelper::getInputText('Company', 'F&ouml;retag', 'F&ouml;retagsnamn (ej privatperson)', '', 'large', TRUE);
    print PayhubHelper::getInputText('Street', 'Gatuadress', 'Adressgatan 1', '', 'large', TRUE);
    print PayhubHelper::getInputText('Careof', 'c/o', 'c/o adressen', '', 'large', TRUE);
    print PayhubHelper::getInputText('Zip', 'Postnummer', '123 45', '', 'small', TRUE);
    print PayhubHelper::getInputText('City', 'Ort', 'Ort', '','medium', TRUE);
    print PayhubHelper::getInputText('Country', 'Land', 'Sverige', 'Sverige','medium', TRUE);
    ?>
    <div class="control-group">
        <div class="controls">
            <div id="errorContainer"></div>
            <button id="btnContinueKlarna" type="submit" class="btn btn-primary">Forts&auml;tt</button>
        </div>
    </div>
    <input name="option" value="com_payhub" type="hidden">
        <input name="orderId" value="1" type="hidden">
        <input name="option" value="com_payhub" type="hidden">
        <input name="view" value="klarna" type="hidden">
        <input name="task" value="processPayment" type="hidden">
        <?php echo JHTML::_( 'form.token' ); ?>
</form>

