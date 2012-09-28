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
}
