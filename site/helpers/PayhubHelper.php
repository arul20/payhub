<?php
/**
 * Description of PayhubHelper
 *
 * @author Daniel Eliasson Stilero Webdesign http://www.stilero.com
 */
class PayhubHelper {
    public static function loadClasses(){
        define('PATH_PAYHUBCLASSES', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_payhub'.DS.'classes'.DS);
        require_once PATH_PAYHUBCLASSES.'article.php';
    }
    
    public static function addBootstrapJS(){
        $document =& JFactory::getDocument();
        $document->addScript(JURI::base().'/media/payhub/bootstrap/js/bootstrap.min.js');
    }
    
    public static function addJqueryJS(){
        $document =& JFactory::getDocument();
        $document->addScript('http://code.jquery.com/jquery-latest.js');
    }
    
    public static function addBootstrapCSS(){
        $document =& JFactory::getDocument();
        $document->addStyleSheet(JURI::base().'/media/payhub/bootstrap/css/bootstrap.min.css');
    }
    
    public static function addAdressJS(){
        $document =& JFactory::getDocument();
        $document->addScript(JURI::base().'/media/payhub/js/adress.js');
    }
    
    public static function getInputText($id, $label, $placeholder='', $value='', $size='medium', $disabled=false, $type='text'){
        $label = htmlentities($label);
        $placeholder = htmlentities($placeholder);
        $disabled = $disabled ? ' disabled' : '';
        $html = '<div class="control-group">';
        $html .= '<label class="control-label" for="input'.$id.'">'.$label.'</label>';
        $html .= '<div class="controls">';
        $html .= '<input class="input-'.$size.'" type="'.$type.'" id="input'.$id.'" placeholder="'.$placeholder.'" value="'.$value.'"'.$disabled.'>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
}
