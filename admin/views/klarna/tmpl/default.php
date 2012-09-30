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
 * This file is part of default.
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
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
    <div class="col100">
        <fieldset class="adminform">
            <legend><?php echo JText::_( 'Klarna Settings' ); ?></legend>
            <table class="admintable">
                <tr>
                    <td width="100" align="right" class="key">
                        <label for="mid">
                        <?php echo JText::_( 'Merchant ID' ); ?>:
                        </label>
                    </td>
                    <td>
                        <input class="inputbox" type="text"
                        name="mid" id="mid" size="25"
                        value="<?php echo $this->item->mid;?>" />
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right" class="key">
                        <label for="shared_secret">
                            <?php echo JText::_( 'Shared Secret' ); ?>:
                        </label>
                    </td>
                    <td>
                        <input class="inputbox" type="text"
                        name="shared_secret" id="shared_secret" size="10"
                        value="<?php echo $this->item->shared_secret;?>" />
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right" class="key">
                        <label for="country">
                            <?php echo JText::_( 'Country' ); ?>:
                        </label>
                    </td>
                    <td>
                    <?php
                        $currentValue = $this->item->country;
                        $countries = array();
                        foreach ($this->countries as $key => $value) {
                            $countries[] = JHTML::_('select.option', $value, JText::_($key));
                        }
                        print JHTML::_('select.genericlist', $countries, 'country', null, 'value', 'text', $currentValue);
                    ?>
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right" class="key">
                        <label for="language">
                            <?php echo JText::_( 'Language' ); ?>:
                        </label>
                    </td>
                    <td>
                        <?php
                        $currentValue = $this->item->language;
                        $languages = array();
                        foreach ($this->languages as $key => $value) {
                            $languages[] = JHTML::_('select.option', $value, JText::_($key));
                        }
                        print JHTML::_('select.genericlist', $languages, 'language', null, 'value', 'text', $currentValue);
                    ?>
                    </td>
                </tr>
                 <tr>
                    <td width="100" align="right" class="key">
                        <label for="currency">
                            <?php echo JText::_( 'Currency' ); ?>:
                        </label>
                    </td>
                    <td>
                        <?php
                        $currentValue = $this->item->currency;
                        $currencies = array();
                        foreach ($this->currencies as $key => $value) {
                            $currencies[] = JHTML::_('select.option', $value, JText::_($key));
                        }
                        print JHTML::_('select.genericlist', $currencies, 'currency', null, 'value', 'text', $currentValue);
                    ?>
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right" class="key">
                        <label for="beta_mode">
                            <?php echo JText::_( 'Beta Mode' ); ?>:
                        </label>
                    </td>
                    <td>
                        <?php
                            $currentValue = $this->item->beta_mode;
                            $options = array(
                                JHTML::_('select.option', 0, JText::_('Off')),
                                JHTML::_('select.option', 1, JText::_('On')),
                            );
                            print JHTML::_('select.genericlist', $options, 'beta_mode', null, 'value', 'text', $currentValue);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right" class="key">
                        <label for="ssl_mode">
                            <?php echo JText::_( 'SSL Mode' ); ?>:
                        </label>
                    </td>
                    <td>
                    <?php
                    $currentValue = $this->item->ssl_mode;
                        $options = array(
                            JHTML::_('select.option', 0, JText::_('Off')),
                            JHTML::_('select.option', 1, JText::_('On')),
                        );
                        print JHTML::_('select.genericlist', $options, 'ssl_mode', null, 'value', 'text', $currentValue);
                    ?>
                        </td>
                </tr>
                <tr>
                    <td width="100" align="right" class="key">
                        <label for="logging">
                            <?php echo JText::_( 'Logging' ); ?>:
                        </label>
                    </td>
                    <td>
                        <?php
                        $currentValue = $this->item->logging;
                            $options = array(
                                JHTML::_('select.option', 0, JText::_('Off')),
                                JHTML::_('select.option', 1, JText::_('On')),
                            );
                            print JHTML::_('select.genericlist', $options, 'logging', null, 'value', 'text', $currentValue);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right" class="key">
                        <label for="created">
                            <?php echo JText::_( 'Created' ); ?>:
                        </label>
                    </td>
                    <td>
                        <?php echo JHTML::_( 'calendar',
                        JHTML::_('date',
                        $this->item->created,
                        JTEXT::_('m/d/Y')),
                        'created',
                        'created',
                        'm/d/Y',
                        array( 'class'=>'inputbox',
                        'size'=>'25',
                        'maxlength'=>'19' ) ); ?>
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>
    <div class="clr"></div>
    <input type="hidden" name="option"
    value="<?php echo JRequest::getVar( 'option' ); ?>" />
    <input type="hidden" name="view"
    value="<?php echo JRequest::getVar( 'view' ); ?>" />
    <input type="hidden" name="id"
    value="<?php echo $this->item->id; ?>" />
    <input type="hidden" name="task" value="" />
</form>