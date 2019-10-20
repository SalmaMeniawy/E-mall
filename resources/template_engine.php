<?php    
    namespace smarty\templateEngine;
    use Smarty;

    use function helpers\config;
    
    class TemplateEngine{
        private static $engine = null;

        /**
         * @return Object smarty object
         */
        public function __construct(){
            if(is_null(self::$engine)){
                self::$engine = new Smarty();
                self::$engine->setTemplateDir(config("TemplateDir"));
                self::$engine->setCompileDir(config("cmpTemplateDir"));
            }
            return self::$engine;
        }
    }