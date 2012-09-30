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
 * This file is part of view.html.
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
require_once JPATH_COMPONENT.DS.'helpers'.DS.'KlarnaHelper.php'; 
KlarnaHelper::loadClasses(); 
/**
 * HTML View class for the HelloWorld Component
 */
class PayHubViewKlarna extends JView{
    
    protected $countries;
    protected $languages;
    protected $currencies;

    public function __construct() {
        parent::__construct();
        $this->countries = array(
            'Sweden' => KlarnaCountry::SE,
            'Denmark' => KlarnaCountry::DK,
            'Finland' => KlarnaCountry::FI,
            'Norway' => KlarnaCountry::NO
        );
        $this->languages = array(
            'Swedish' => KlarnaLanguage::SV,
            'Danish' => KlarnaLanguage::DA,
            'Finnish' => KlarnaLanguage::FI,
            'Norwegian' => KlarnaLanguage::NB
        );
        $this->currencies = array(
            'SEK' => KlarnaCurrency::SEK,
            'EUR' => KlarnaCurrency::EUR,
            'DKK' => KlarnaCurrency::DKK,
            'NOK' => KlarnaCurrency::NOK
        );
        $this->assignRef('currencies', $this->currencies);
        $this->assignRef('countries', $this->countries);
        $this->assignRef('languages', $this->languages);
    }
    
    function edit($id) {
        JToolBarHelper::title(JText::_('PayHub Klarna: [<small>Edit</small>]', 'generic.png'));
        JToolBarHelper::save();
        JToolBarHelper::cancel('cancel', 'Close');
        $model =& $this->getModel();
        $item = $model->getKlarna( $id );
        $this->assignRef('item', $item);
        parent::display();
    }
    
    function add(){
        JToolBarHelper::title( JText::_('PayHub Klarna')
                . ': [<small>Add</small>]' );
        JToolBarHelper::save();
        JToolBarHelper::cancel();
        $model =& $this->getModel();
        $item = $model->getNewKlarna();
        $this->assignRef('item', $item);
        parent::display();
    }
}
