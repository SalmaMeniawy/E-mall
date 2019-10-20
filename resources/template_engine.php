<?php    

    namespace smarty\templateEngine;

    class TemplateEngine{
        private static $engine = null;

        /**
         * @return Object smarty object
         */
        private function __construct(){
            if(is_null(self::$engine)){
                self::$engine = new Smarty();
            } 
            return self::$engine;
        }

        public static function get_smarty(){
            return $this->__construct();
        }
    }