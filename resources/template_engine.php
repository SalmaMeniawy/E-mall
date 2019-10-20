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
                self::$engine->template_dir = __DIR__ ."/resources/views";
                self::$engine->compile_dir = __DIR__ ."/resources/tmp";
                // self::$engine->setTemplateDir(config("TemplateDir"));
                // self::$engine->setCompileDir(config("cmpTemplateDir"));
            }
            // print_r(self::$engine);
            return self::$engine;
        }
    }