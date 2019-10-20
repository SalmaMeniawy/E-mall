<?php
    require_once dirname(__FILE__,2) . "/vendor/autoload.php";
    
    class TemplateEngine{
        private static $engine = null;

        /**
         * @return Object smarty object
         */
        public function __construct(){
            if(is_null(self::$engine)){
                self::$engine = new Smarty();
            } 
            return self::$engine;
        }
    }