<?php

    namespace helpers;
    $configuration = null;
    /**
     * read the configuration file into an associative array
     * 
     * @param string $param key to get its value from config file
     * 
     * @return string
     */
    function config(string $param){
        $config_file_dir = dirname(__FILE__,2)."/settings.conf";
        if(!isset($configuration)){
            $configuration = (object) parse_ini_file($config_file_dir);
        }
        return $configuration->$param;
    }