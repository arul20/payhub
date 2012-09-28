<?php
/**
 * Description of Article
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
 * This file is part of article.
 * 
 * Article is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * Article is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with Article.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 

class Article{
    protected $quantity;
    protected $sku;
    protected $name;
    protected $price;
    protected $vatPercent;
    protected $discountPercent;
    protected $isVatIncluded;
        
    public function __construct($quantity, $sku, $name, $price, $vatPercent=25, $discountPercent=0, $isVatIncluded=true){
        $this->quantity = $quantity;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->vatPercent = $vatPercent;
        $this->discountPercent = $discountPercent;
        $this->isVatIncluded = $isVatIncluded;
    }
}
