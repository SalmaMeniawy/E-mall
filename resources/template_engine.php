<?php    
    namespace smarty\templateEngine;
    use Smarty;

    use function helpers\config;
    
    class TemplateEngine{
        public static $engine = null;

        /**
         * @return Object smarty object
         */
        public static function get_smarty(){
            if(is_null(self::$engine)){
                self::$engine = new Smarty();
                self::$engine->setTemplateDir(config("TemplateDir"));
                self::$engine->setCompileDir(config("cmpTemplateDir"));
                self::$engine->setConfigDir(config("configDir"));
                self::$engine->setCacheDir(config("cacheDir"));
            }

            return self::$engine;
        }
    }