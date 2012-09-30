<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DashboardHelper
 *
 * @author Daniel Eliasson Stilero Webdesign http://www.stilero.com
 */
class DashboardHelper {
   public static function addButton($href, $imgSrc, $iconText){
       $html =  '<div class="icon-wrapper">'.
                    '<div class="icon">'.
                        '<a href="'.$href.'">'.
                        '<img src="'.$imgSrc.'" alt=""  />'.
                            '<span>'.$iconText.'</span>'.
                        '</a>'.
                    '</div>'.
                '</div>';
       print $html;
   }
}

