<?php

    namespace configLoader;
    class ConfigLoader{
        private static $configuration = null;
        /**
         * read the configuration file into an associative array
         */
        public function config(string $param){
            if(!isset(self::$configuration)){
                $this->load_config();            
            }
            return self::$configuration->$param;
        }
        
        /**
         * this function loads application-wide settings from global config file
         */
        private function load_config(){
            $config_filename = dirname(__FILE__,2)."/settings.conf";
            self::$configuration = (object) parse_ini_file($config_filename);
        }
    }