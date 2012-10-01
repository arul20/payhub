<?php
/**
 * Description of PayHub
 *
 * @version  1.0
 * @author Daniel Eliasson Stilero Webdesign http://www.stilero.com
 * @copyright  (C) 2012-okt-01 Stilero Webdesign, Stilero AB
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
            <legend><?php echo JText::_( 'Details' ); ?></legend>
            <table class="admintable">
                <tr>
                    <td width="100" align="right" class="key">
                        <label for="title">
                        <?php echo JText::_( 'Fee Title' ); ?>:
                        </label>
                    </td>
                    <td>
                        <input class="inputbox" type="text"
                        name="title" id="title" size="25"
                        value="<?php echo $this->fee->title;?>" />
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right" class="key">
                        <label for="sku">
                            <?php echo JText::_( 'SKU' ); ?>:
                        </label>
                    </td>
                    <td>
                        <input class="inputbox" type="text"
                        name="sku" id="sku" size="10"
                        value="<?php echo $this->fee->sku;?>" />
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right" class="key">
                        <label for="price">
                            <?php echo JText::_( 'Price' ); ?>:
                        </label>
                    </td>
                    <td>
                        <input class="text_area" type="text"
                        name="price" id="price"
                        size="32" maxlength="250"
                        value="<?php echo $this->fee->price;?>" />
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right" class="key">
                        <label for="vat">
                            <?php echo JText::_( 'VAT' ); ?>:
                        </label>
                    </td>
                    <td>
                        <input class="inputbox" type="text"
                        name="vat" id="vat" size="50"
                        value="<?php echo $this->fee->vat;?>" />
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right" class="key">
                        <label for="published">
                            <?php echo JText::_( 'Published' ); ?>:
                        </label>
                    </td>
                    <td>
                        <?php echo JHTML::_( 'select.booleanlist', 
                                'published', 
                                'class="inputbox"', 
                                $this->fee->published ); 
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
                        $this->fee->created,
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
    value="<?php echo $this->fee->id; ?>" />
    <input type="hidden" name="task" value="" />
</form>