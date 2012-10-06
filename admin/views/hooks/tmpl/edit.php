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
 * This file is part of form.
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
            <legend><?php echo JText::_( 'Details' ); ?></legend>
            <table class="admintable">
                <tr>
                    <td width="100" align="right" class="key">
                        <label for="payment_id">
                        <?php echo JText::_( 'Payment' ); ?>:
                        </label>
                    </td>
                   <td>
                        <?php
                        $currentValue = $this->item->payment_id;
                        $payments = array();
                        foreach ($this->payments as $payment) {
                            $payments[] = JHTML::_('select.option', $payment->id, JText::_($payment->title));
                        }
                        print JHTML::_('select.genericlist', $payments, 'payment_id', null, 'value', 'text', $currentValue);
                    ?>
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right" class="key">
                        <label for="action_id">
                            <?php echo JText::_( 'Action' ); ?>:
                        </label>
                    </td>
                    <td>
                        <?php
                        $currentValue = $this->item->action_id;
                        $actions = array();
                        foreach ($this->actions as $action) {
                            $actions[] = JHTML::_('select.option', $action->id,  JText::_($action->title));
                        }
                        print JHTML::_('select.genericlist', $actions, 'action_id', null, 'value', 'text', $currentValue);
                    ?>
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>
    <div class="clr"></div>
    <input type="hidden" name="option" value="<?php echo JRequest::getVar( 'option' ); ?>" />
    <input type="hidden" name="view" value="<?php echo JRequest::getVar( 'view' ); ?>" />
    <input type="hidden" name="id" value="<?php echo $this->item->id; ?>" />
    <input type="hidden" name="task" value="" />
</form>