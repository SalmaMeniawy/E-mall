<?php    

    namespace smarty\TemplateEngine;
    
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