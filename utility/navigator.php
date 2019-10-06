<?php
    class Navigator{
        private static $configuration = array();
        /**
         * read the configuration file into an associative array
         */
        public function config(string $param){
            if(!isset($this->configuration)){
                $this->load_config();            
            }
            return $this->configuration[$param];
        }
        
        /**
         * this function loads application-wide settings from global config file
         */
        private function load_config(){
            $config = fopen("../settings.conf", "r");
            $settings_array = file($config);
            foreach ($settings_array as $setting) {
                list($key, $value) = explode("=", $setting);
                $this->configuration[$key] = $value;
            }

            fclose($config);
        }
    }